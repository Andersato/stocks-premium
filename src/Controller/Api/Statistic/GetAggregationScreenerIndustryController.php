<?php

declare(strict_types=1);


namespace App\Controller\Api\Statistic;

use App\Constant\ElasticsearchConstants;
use App\Controller\Api\AppAbstractController;
use App\Repository\Filters\Statistics\StatisticFilter;
use App\Service\Statistic\GetAggregationsToFiltersService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class GetAggregationScreenerIndustryController extends AppAbstractController
{

    public function __construct(
        private GetAggregationsToFiltersService $getAggregationsToFiltersService,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        TranslatorInterface $translator
    )
    {
        parent::__construct($validator, $serializer, $translator);
    }


    /**
     * @throws \JsonException
     */
    #[Route(path: '/api/statistics/screener/aggs/industries', name: 'get_aggregations_screener_industries', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] StatisticFilter $statisticFilter = new StatisticFilter()
    ): JsonResponse
    {
        $response = ($this->getAggregationsToFiltersService)(
            $statisticFilter,
            [
                ElasticsearchConstants::AGGS_INDUSTRY
            ]
        );

        return new JsonResponse($this->serialize($response));
    }
}