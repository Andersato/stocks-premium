<?php

namespace App\Command;

use App\Model\InformationItem\DateInformationType;
use App\Model\InformationItem\QuantityInformationType;
use App\Model\InformationItem\VolumeInformationType;
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

#[AsCommand(
    name: 'app:create-informations-items',
    description: 'Crea todos los items para la información de las empresas',
)]
class CreateInformationItemCommand extends Command
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);




        $io->success('Se han leido todos los datos correctamente.');

        return Command::SUCCESS;
    }
}
