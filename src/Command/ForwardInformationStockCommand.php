<?php

namespace App\Command;

use App\Constant\ElasticsearchConstants;
use App\Entity\InformationStockReject;
use App\Message\AddInformationStockMessage;
use Doctrine\ORM\EntityManagerInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:forward-information-stock',
    description: 'Se encarga de reenviar a la cola las acciones que han fallado en el proceso diario',
)]
class ForwardInformationStockCommand extends Command
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MessageBusInterface $bus
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $informationStocks = $this->entityManager->getRepository(InformationStockReject::class)->findAll();
        $i = 0;

        foreach ($informationStocks as $informationStock) {
            $this->bus->dispatch(
                new AddInformationStockMessage(
                    $informationStock->getTicker(),
                    $informationStock->getStockName(),
                    $i
                )
            );
            $io->info(sprintf('Se ha enviado la acción con ticker %s y nombre %s',
                $informationStock->getTicker(),
                $informationStock->getStockName()
            ));
            $this->entityManager->remove($informationStock);
            $this->entityManager->flush();
            ++$i;
        }

        $io->success(sprintf('Se han enviado %d acciones a la cola.', $i));

        return Command::SUCCESS;
    }
}
