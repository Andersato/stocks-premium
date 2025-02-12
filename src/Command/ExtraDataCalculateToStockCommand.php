<?php

namespace App\Command;

use App\Constant\ElasticsearchConstants;
use App\Entity\InformationStock;
use App\Entity\InformationStockReject;
use App\Message\AddInformationStockMessage;
use App\Service\InformationStock\ExtraData\CalculateExtraDataService;
use App\Service\InformationStock\Split\ApplySplitStocksService;
use Doctrine\ORM\EntityManagerInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use phpDocumentor\Reflection\Types\Integer;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:calculate-extra-data-stock',
    description: 'Se calculan diferentes métricas para las acciones, a partir de sus propios datos',
)]
class ExtraDataCalculateToStockCommand extends Command
{
    public function __construct(
        private readonly CalculateExtraDataService $calculateExtraDataService,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $ticker = 'META';

        ($this->calculateExtraDataService)($ticker);

        $io->success(sprintf('Se han calculado las medias móviles para la acción %s.', $ticker));

        return Command::SUCCESS;
    }
}
