<?php

namespace App\Repository;

use App\Constant\FiltersConstants;
use App\Constant\InformationStockConstants;
use App\Dto\InformationStock\GetFiltersListInformationStockDto;
use App\Entity\InformationStock;
use App\Entity\Stock;
use App\Repository\Filters\GetMarketCapFilter;
use App\Repository\Filters\GetPerFilter;
use App\Repository\Filters\GetHigh52WFilter;
use App\Response\InformationStock\List\GetListInformationStockResponse;
use App\Response\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationStock>
 *
 * @method InformationStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationStock[]    findAll()
 * @method InformationStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationStockRepository extends ServiceEntityRepository
{
    final public const LAST_WEEK = 7;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationStock::class);
    }

    public function findByStockAndDate(Stock $stock, \DateTimeInterface $date): ?InformationStock
    {
        $qb = $this->createQueryBuilder('informationStock')
            ->where('informationStock.stock = :stock')
            ->andWhere('informationStock.createdAt = :date')
            ->setParameter('stock', $stock)
            ->setParameter('date', $date->format('Y-m-d'));

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findAllPaginate(int $limit, int $offset): Paginator
    {
        $qb = $this->createQueryBuilder('informationStock')
            ->select('informationStock.id,informationStock.createdAt')
            ->where('informationStock.priceOpen IS NULL')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('informationStock.id', 'asc')
            ->getQuery();

        $paginator = new Paginator($qb);
        $paginator->setUseOutputWalkers(false);

        return $paginator;
    }

    public function findDataByMetrics(string $ticker, array $metrics): array
    {
        $metricsString = '';
        foreach ($metrics as $metric) {
            $metricsString .= ',informationStock.'.$metric;
        }

        $qb = $this->createQueryBuilder('informationStock')
            ->join('informationStock.stock', 'stock')
            ->select('informationStock.id,informationStock.createdAt'.$metricsString)
            ->where('stock.ticker = :ticker')
            ->setParameter('ticker', $ticker)
            ->orderBy('informationStock.createdAt', 'asc')
            ->getQuery();

        return $qb->getScalarResult();
    }

    public function findByFilters(GetFiltersListInformationStockDto $filters, int $page = 1, int $limit = 30): Query
    {
        $result = $this->createQueryBuilder('informationStock')
                ->select('MAX(informationStock.createdAt) as maxDate')
                ->getQuery()->getScalarResult();
        $maxDate = $result[0]['maxDate'];

        $qb = $this->createQueryBuilder('informationStock')
            ->select('informationStock.id,stock.id,stock.ticker,stock.name,stock.sector,stock.industry,
            informationStock.price,informationStock.marketCap,informationStock.range52W,informationStock.high52W')
            ->join('informationStock.stock', 'stock');

        $qb->where('informationStock.createdAt = :maxDate')
            ->setParameter('maxDate', $maxDate)
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit);

        if ($filters->getSector()) {
            $qb->andWhere('stock.sector = :sector')
                ->setParameter('sector', $filters->getSector());
        }

        if ($filters->getMarketCap()) {
            GetMarketCapFilter::get($qb, $filters->getMarketCap());
        }

        if ($filters->getPer()) {
            GetPerFilter::get($qb, $filters->getPer());
        }

        if ($filters->getHigh52W()) {
            GetHigh52WFilter::get($qb, $filters->getHigh52W());
        }

        $qb->addOrderBy('stock.ticker', 'ASC');

        return $qb->getQuery();
    }

    public function findLastByTicker(string $ticker): ?InformationStock
    {
        $qb = $this->createQueryBuilder('informationStock')
            ->join('informationStock.stock', 'stock')
            ->where('stock.ticker = :ticker')
            ->setParameter('ticker', $ticker)
            ->setMaxResults(1)
            ->orderBy('informationStock.createdAt', 'DESC');

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByMarketCap(string $marketCap, array $filters = [], array $parameters = [], $maxResults = 20): array
    {
        $qb = $this->createQueryBuilder('informationStock')
            ->select('stock.id,stock.ticker,stock.name,stock.sector,stock.industry,informationStock.price,informationStock.prevClose,informationStock.changeToday,informationStock.marketCap')
            ->join('informationStock.stock', 'stock');

        $maxCreatedAt = $this->createQueryBuilder('infStock')
            ->select('MAX(infStock.createdAt) as maxCreatedAt')
            ->getQuery()->getScalarResult();

        $qb
            ->where('informationStock.createdAt = :maxCreatedAt')
            ->setParameter('maxCreatedAt', $maxCreatedAt[0]['maxCreatedAt']);

        switch ($marketCap) {
            case InformationStockConstants::SMALL_CAPS:
                $qb->andWhere('informationStock.marketCap <= 2000'); break;
            case InformationStockConstants::MID_CAPS:
                $qb->andWhere('informationStock.marketCap > 2000 and informationStock.marketCap <= 10000'); break;
            case InformationStockConstants::LARGE_CAPS:
                $qb->andWhere('informationStock.marketCap > 10000 and informationStock.marketCap < 200000'); break;
            case InformationStockConstants::MEGA_CAPS:
                $qb->andWhere('informationStock.marketCap > 200000'); break;
        }

        if (in_array(InformationStockConstants::FILTER_TOP_GAINERS, $filters)) {
            $qb
                ->andWhere('informationStock.changeToday > 0')
                ->addOrderBy('informationStock.changeToday', 'DESC');
        }

        if (in_array(InformationStockConstants::FILTER_TOP_LOSERS, $filters)) {
            $qb
                ->andWhere('informationStock.changeToday < 0')
                ->addOrderBy('informationStock.changeToday', 'ASC');
        }

        if (isset($parameters[InformationStockConstants::FILTER_SECTOR])) {
            $qb
                ->andWhere('stock.sector = :sector')
                ->setParameter('sector', $parameters[InformationStockConstants::FILTER_SECTOR]);
        }

        $qb
            ->setMaxResults($maxResults);

        return $qb->getQuery()->getArrayResult();
    }

    public function findDatesToStatisticsElastic(string $ticker): array
    {
        $qb = $this->createQueryBuilder('informationStock')
            ->select('informationStock.createdAt as date')
            ->join('informationStock.stock', 'stock')
            ->where('stock.ticker = :ticker')
            ->setParameter('ticker', $ticker)
            ->orderBy('informationStock.createdAt', 'DESC')
            ->setMaxResults(self::LAST_WEEK);

        return $qb->getQuery()->getArrayResult();
    }

    public function findByTickerAndDate(string $ticker, \DateTimeInterface $date): ?InformationStock
    {
        $qb = $this->createQueryBuilder('informationStock')
            ->join('informationStock.stock', 'stock')
            ->where('stock.ticker = :ticker')
            ->andWhere('informationStock.createdAt = :date')
            ->setParameter('ticker', $ticker)
            ->setParameter('date', $date->format('Y-m-d'));

        return $qb->getQuery()->getOneOrNullResult();
    }
}
