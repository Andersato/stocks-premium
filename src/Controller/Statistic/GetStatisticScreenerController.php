<?php

declare(strict_types=1);


namespace App\Controller\Statistic;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetInformationStockMetricsDto;
use App\Form\Statistic\StatisticFilterFormType;
use App\Repository\Filters\Statistics\StatisticFilter;
use App\Service\InformationStock\Graphics\GetDataGraphicsByMetricsService;
use App\Service\Statistic\GenerateAggregationsToFiltersService;
use App\Service\Statistic\GenerateFiltersDataService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class GetStatisticScreenerController extends AppAbstractController
{

    public function __construct(
        private GenerateFiltersDataService $generateFiltersDataService,
        private GenerateAggregationsToFiltersService $generateAggregationsToFiltersService,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        TranslatorInterface $translator
    )
    {
        parent::__construct($validator, $serializer, $translator);
    }


    #[Route(path: '/api/statistics/screener', name: 'get_statistics_screener', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] StatisticFilter $statisticFilter
    ): JsonResponse
    {
        //$aggregations = ($this->generateAggregationsToFiltersService)($filters);

//        $statisticFilter = new StatisticFilter();
//        $form = $this->createForm(StatisticFilterFormType::class, $statisticFilter, [
//            'aggregations' => $aggregations
//        ]);
//        $form->handleRequest($request);


        $response = ($this->generateFiltersDataService)($statisticFilter);
        dd($response);

        return new JsonResponse($this->serializeArray($response));
    }
}