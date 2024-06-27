<?php

declare(strict_types=1);


namespace App\Controller\Api\InformationStock;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetInformationStockMetricsDto;
use App\Service\InformationStock\Graphics\GetDataGraphicsByMetricsService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class GetInsiderOwnStockController extends AppAbstractController
{
    private GetDataGraphicsByMetricsService $dataGraphicsByMetricsService;

   public function __construct(
       GetDataGraphicsByMetricsService $dataGraphicsByMetricsService,
       ValidatorInterface $validator,
       SerializerInterface $serializer
   )
   {
       $this->dataGraphicsByMetricsService = $dataGraphicsByMetricsService;
       parent::__construct($validator, $serializer);
   }


    /**
     * @throws \JsonException
     */
    #[Route(path: '/api/stock-data-graphics/{ticker}/metrics', name: 'get_stock_data_graphics', methods: ['GET'])]
    public function __invoke(
        string $ticker,
        #[MapQueryString] GetInformationStockMetricsDto $informationStockMetricsDto
    ): JsonResponse
    {
        $informationStockMetricsDto->setTicker($ticker);

        $dataResponse = ($this->dataGraphicsByMetricsService)($informationStockMetricsDto);

        return new JsonResponse($this->serializeArray($dataResponse));
    }
}