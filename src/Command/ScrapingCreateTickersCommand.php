<?php

namespace App\Command;

use App\Entity\Stock;
use App\Message\AddInformationStockMessage;
use Doctrine\ORM\EntityManagerInterface;
use DOMDocument;
use Goutte\Client;
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

    public function __construct(
        EntityManagerInterface $entityManager,
        MessageBusInterface $bus
    )
    {
        $this->entityManager = $entityManager;
        $this->bus = $bus;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(
            new AddInformationStockMessage(
                'A',
                'dsfs'
            )
        );die;

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
            $table->each(function (Crawler $tbody) {
                $tbody->children('tr')->each(function (Crawler $tr){
                    $tdTicker = $tr->children('td')->eq(1);
                    $tdName = $tr->children('td')->eq(2);
                    $ticker = $tdTicker->filter('a')->text();
                    $name = $tdName->filter('a')->text();
                    $this->bus->dispatch(
                        new AddInformationStockMessage(
                            $ticker,
                            $name
                        )
                    );
                });
            });
            unset($table);
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
