<?php

namespace App\Command;

use App\Constant\ElasticsearchConstants;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-index-elasticsearch',
    description: 'Se encarga de crear el índice en elasticsearch para las estadísticas de las acciones',
)]
class CreateIndexElasticsearchCommand extends Command
{
    private Client $client;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly string $elasticsearchHost,
        private readonly string $elasticsearchUser,
        private readonly string $elasticsearchPassword,
        private readonly bool $elasticsearchSslVerification
    )
    {
        try {
            $this->client = ClientBuilder::create()
                ->setHosts([$this->elasticsearchHost])
                ->setBasicAuthentication($this->elasticsearchUser, $this->elasticsearchPassword)
                ->setSSLVerification($this->elasticsearchSslVerification)
                ->build()
            ;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

        parent::__construct();
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws MissingParameterException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $params = [
            'index' => ElasticsearchConstants::INDEX_NAME,
            'body' => [
                'settings' => [
                    'index' => [
                        'requests' => [
                            'cache' => [
                                'enable' => true
                            ]
                        ]
                    ]
                ],
                'mappings' => [
                    'properties' => [
                        ElasticsearchConstants::FIELD_TICKER => [
                            'type' => 'keyword'
                        ],
                        ElasticsearchConstants::FIELD_NAME => [
                            'type' => 'keyword'
                        ],
                        ElasticsearchConstants::FIELD_PRICE => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_SECTOR => [
                            'type' => 'keyword'
                        ],
                        ElasticsearchConstants::FIELD_INDUSTRY => [
                            'type' => 'keyword'
                        ],
                        ElasticsearchConstants::FIELD_MARKET_CAP => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_VOLUME => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_RELATIVE_VOLUME => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_INST_OWN => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_INST_OWN_WEEK => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_INSIDER_OWN => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_INSIDER_OWN_WEEK => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_SHORT_FLOAT => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_SHORT_FLOAT_WEEK => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_CHANGE_PRICE => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_PERF_WEEK => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_PERF_MONTH => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_PERF_QUARTER => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_PERF_HALF_YEAR => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_PERF_YEAR => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_PERF_YTD => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_HIGH_52W => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_EPS_YY_TTM => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_EPS_QQ => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_SALES_YY_TTM => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_SALES_QQ => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_RSI => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_VOLUME => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_AVG_VOLUME => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_ROI => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_ROE => [
                            'type' => 'float'
                        ],
                        ElasticsearchConstants::FIELD_ROA => [
                            'type' => 'float'
                        ],
                    ]
                ]
            ]
        ];

        try {
            $this->client->indices()->delete(['index' => ElasticsearchConstants::INDEX_NAME]);
        } catch (\Exception){}

        $this->client->indices()->create($params);

        $io->success('Se creado el indice correctamente.');

        return Command::SUCCESS;
    }
}
