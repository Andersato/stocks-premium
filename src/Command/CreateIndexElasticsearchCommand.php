<?php

namespace App\Command;

use App\Constant\ElasticsearchConstants;
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

#[AsCommand(
    name: 'app:create-index-elasticsearch',
    description: 'Se encarga de crear el índice en elasticsearch para las estadísticas de las acciones',
)]
class CreateIndexElasticsearchCommand extends Command
{
    private Client $client;

    /**
     * @throws AuthenticationException
     */
    public function __construct(
        private readonly string $elasticsearchHost
    )
    {
        $this->client = ClientBuilder::create()->setHosts([$elasticsearchHost])->build();

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
                        'ticker' => [
                            'type' => 'keyword'
                        ],
                        'name' => [
                            'type' => 'keyword'
                        ],
                        'price' => [
                            'type' => 'float'
                        ],
                        'sector' => [
                            'type' => 'keyword'
                        ],
                        'industry' => [
                            'type' => 'keyword'
                        ],
                        'marketCap' => [
                            'type' => 'float'
                        ],
                        'changeVolume' => [
                            'type' => 'float'
                        ],
                        'changeRelativeVolume' => [
                            'type' => 'float'
                        ],
                        'changeInstOwn' => [
                            'type' => 'float'
                        ],
                        'changeInstOwnWeek' => [
                            'type' => 'float'
                        ],
                        'changeInsiderOwn' => [
                            'type' => 'float'
                        ],
                        'changeInsiderOwnWeek' => [
                            'type' => 'float'
                        ],
                        'changeShortFloat' => [
                            'type' => 'float'
                        ],
                        'changeShortFloatWeek' => [
                            'type' => 'float'
                        ],
                        'changePrice' => [
                            'type' => 'float'
                        ],
                        'perfWeek' => [
                            'type' => 'float'
                        ],
                        'perfMonth' => [
                            'type' => 'float'
                        ],
                        'perfQuarter' => [
                            'type' => 'float'
                        ],
                        'perfHalfYear' => [
                            'type' => 'float'
                        ],
                        'perfYear' => [
                            'type' => 'float'
                        ],
                        'perfYtd ' => [
                            'type' => 'float'
                        ],
                        'high52W' => [
                            'type' => 'float'
                        ],
                        'epsYYTtm' => [
                            'type' => 'float'
                        ],
                        'epsQQ' => [
                            'type' => 'float'
                        ],
                        'salesYYTtm' => [
                            'type' => 'float'
                        ],
                        'salesQQ' => [
                            'type' => 'float'
                        ],
                        'rsi' => [
                            'type' => 'float'
                        ],
                        'volume' => [
                            'type' => 'float'
                        ],
                        'avgVolume' => [
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
