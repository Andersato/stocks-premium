<?php

namespace App\Command;

use App\Entity\InformationStock;
use App\Entity\Stock;
use App\Message\AddInformationStockMessage;
use App\Message\AddStatisticsElasticsearchMessage;
use App\Message\SendErrorEmailMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:scraping-create-tickers',
    description: 'Scraping del listado de finviz para crear los tickers',
)]
class ScrapingCreateTickersCommand extends Command
{
    final public const URL_SCREENER = 'https://finviz.com/screener.ashx?f=ind_stocksonly';

    private EntityManagerInterface $entityManager;
    private MessageBusInterface $bus;
    private int $cont;

    public function __construct(
        EntityManagerInterface $entityManager,
        MessageBusInterface $bus
    )
    {
        $this->entityManager = $entityManager;
        $this->bus = $bus;
        $this->cont = 0;

        parent::__construct();
    }

    private function limitString(string $text, int $limit): string
    {
        $limit -= 3;
        $explodeText = explode(' ', $text);
        $cutText = mb_substr($text, 0, $limit, 'UTF-8');

        //Special case
        if (1 === count($explodeText) && str_contains($cutText, '.')) {
            $explodeText = explode('.', $cutText);
            return $explodeText[0].'...';
        }

        //Special case
        if (strlen($text) <= $limit) {
            if (str_contains($cutText, '.')) {
                return str_replace('.', '', $cutText).'...';
            } else {
                return $cutText;
            }
        }

        //Special case
        $explodeCutText = explode(' ', $cutText);
        if (1 === count($explodeCutText)) {
            return str_replace('.', '', $cutText).'...';
        }

        $count = 0;
        $incrementWords = [];
        foreach ($explodeText as $word) {
            $lengthWordAndSpace = strlen($word) + 1;
            $incrementWords[] = $count + $lengthWordAndSpace;
            $count += $lengthWordAndSpace;
        }

        $lengthKeys = count($incrementWords);
        $searchText = false;
        for ($i = 0; $i < $lengthKeys && !$searchText; $i++) {
            if ($limit <= $incrementWords[$i]) {
                $searchText = true;
            }
        }

        return implode(' ', array_slice($explodeText, 0, $i - 1)).'...';
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $client = new HttpBrowser(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', self::URL_SCREENER);
        $textTotal = $crawler->filter('#screener-total')->text();
        preg_match('/\d{3,}/', $textTotal, $matches);
        $total = (int) $matches[0];
        $itemsPerPage = 20;
        $page = 1;
        $numPages = (int) ($total / $itemsPerPage);
        if ( ($total % $itemsPerPage !== 0)) {
            $numPages += 1;
        }
        $items = 1;
        do {
            $table = $crawler->filter('table.screener_table');
            $table->each(function (Crawler $tbody) use ($output) {
                $tbody->children('tr')->each(function (Crawler $tr) use ($output) {
                    $tdTicker = $tr->children('td')->eq(1);
                    $tdName = $tr->children('td')->eq(2);
                    $ticker = $tdTicker->filter('a')->text();
                    $name = $tdName->filter('a')->text();
                    $this->cont++;
                    $this->bus->dispatch(
                        new AddInformationStockMessage(
                            $ticker,
                            $name,
                            $this->cont
                        )
                    );
                    $output->writeln('<question>Se ha enviado a la cola el ticker '.$ticker.' en la posición '.$this->cont.'</question>');
                });
            });
            unset($table);
            sleep(2);
            $output->writeln('<info>Se han añadido las empresas de esta página');

            $items += $itemsPerPage;
            $page++;
            gc_collect_cycles();
            $crawler = $client->request('GET', self::URL_SCREENER."&v111&r=".$items);
        } while ($page <= $numPages);

        $io->success('Se han leido todos los datos correctamente.');

        return Command::SUCCESS;
    }
}
