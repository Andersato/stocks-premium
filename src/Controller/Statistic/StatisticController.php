<?php

declare(strict_types=1);


namespace App\Controller\Statistic;

use App\Form\Statistic\StatisticFilterFormType;
use App\Repository\Filters\Statistics\StatisticFilter;
use App\Service\Statistic\GenerateAggregationsToFiltersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class StatisticController extends AbstractController
{
    private GenerateAggregationsToFiltersService $generateAggregationsToFiltersService;

    public function __construct(GenerateAggregationsToFiltersService $generateAggregationsToFiltersService)
    {
        $this->generateAggregationsToFiltersService = $generateAggregationsToFiltersService;
    }


    #[Route(path: '/statistics', name: 'statistics')]
    public function __invoke(
        Request $request,
        SerializerInterface $serializer
    ): Response
    {
        $data = $request->request->all();
        if (isset($data['statistic_filter_form'])) {
            $data = $data['statistic_filter_form'];
            unset($data['save']);
            $jsonData = json_encode($data);

            /** @var StatisticFilter $filters */
            $filters = $serializer->deserialize($jsonData, StatisticFilter::class, 'json');

            ($this->generateAggregationsToFiltersService)($filters);
        }

        $statisticFilter = new StatisticFilter();
        $form = $this->createForm(StatisticFilterFormType::class, $statisticFilter, [
//            'filters' => $filters ?? $statisticFilter
        ]);
        $form->handleRequest($request);

//        $filters = GetFiltersListInformationStockDto::create(
//            sector: $sector,
//            marketCap: $marketCap,
//            per: $per,
//            high52W: $high52W
//        );

//        $pageResponse = ($this->getListInformationStockService)(
//            GetListInformationStockDto::create(
//                filters: $filters,
//                page: $page,
//                limit: $limit
//            )
//        );

        return $this->render('statistic/index.html.twig', [
            'statisticForm' => $form->createView(),
        ]);
    }
}