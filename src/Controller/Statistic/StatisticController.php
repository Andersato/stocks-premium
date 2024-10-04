<?php

declare(strict_types=1);


namespace App\Controller\Statistic;

use App\Form\Statistic\StatisticFilterFormType;
use App\Repository\Filters\Statistics\StatisticFilter;
use App\Service\Statistic\GenerateAggregationsToFiltersService;
use App\Service\Statistic\GenerateFiltersDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class StatisticController extends AbstractController
{
    private GenerateAggregationsToFiltersService $generateAggregationsToFiltersService;
    private GenerateFiltersDataService $generateFiltersDataService;

    public function __construct(
        GenerateAggregationsToFiltersService $generateAggregationsToFiltersService,
        GenerateFiltersDataService $generateFiltersDataService
    )
    {
        $this->generateAggregationsToFiltersService = $generateAggregationsToFiltersService;
        $this->generateFiltersDataService = $generateFiltersDataService;
    }


    #[Route(path: '/statistics', name: 'statistics')]
    public function __invoke(
        Request $request,
        SerializerInterface $serializer
    ): Response
    {
        $data = $request->request->all();
        $filters = new StatisticFilter();
        if (isset($data['statistic_filter_form'])) {
            $data = $data['statistic_filter_form'];
            unset($data['save']);
            $jsonData = json_encode($data);

            /** @var StatisticFilter $filters */
            $filters = $serializer->deserialize($jsonData, StatisticFilter::class, 'json');
        }

        $aggregations = ($this->generateAggregationsToFiltersService)($filters);

        $statisticFilter = new StatisticFilter();
        $form = $this->createForm(StatisticFilterFormType::class, $statisticFilter, [
            'aggregations' => $aggregations
        ]);
        $form->handleRequest($request);


        $response = ($this->generateFiltersDataService)($statisticFilter);

        return $this->render('statistic/index.html.twig', [
            'statisticForm' => $form->createView(),
            'statistics' => $response
        ]);
    }
}