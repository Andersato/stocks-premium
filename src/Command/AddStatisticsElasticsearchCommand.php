<?php

namespace App\Command;

ini_set('memory_limit', '1024M');

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
    name: 'app:add-statistics-stocks',
    description: 'Añade las estadísticas de las acciones a Elasticsearch',
)]
class AddStatisticsElasticsearchCommand extends Command
{
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
        gc_enable();
        $io = new SymfonyStyle($input, $output);

        $stocks = $this->entityManager->getRepository(Stock::class)->findTickersByStatistics();

        foreach ($stocks as $stock) {
            $this->bus->dispatch(new AddStatisticsElasticsearchMessage(
                ticker: $stock['ticker']
            ));
            $output->writeln(sprintf('<question>Información añadida para la acción con ticker %s</question>', $stock['ticker']));
            gc_collect_cycles();
        }

        $io->success('Se han guardado las estadísticas correctamente.');

        return Command::SUCCESS;
    }
}
