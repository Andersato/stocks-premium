<?php

declare(strict_types=1);


namespace App\Controller\Api\InformationStock;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetInformationStockMetricsDto;
use App\Service\InformationStock\Graphics\GetDataGraphicsByMetricsService;
use App\Service\InformationStock\List\GetTickerToAutocompleteService;
use App\Service\InformationStock\Performance\GetPerformanceHeadersService;
use App\Service\Screener\GetSectorsService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class GetPerformanceHeadersController extends AppAbstractController
{
   public function __construct(
       private readonly GetPerformanceHeadersService $getPerformanceHeadersService,
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
    #[Route(path: '/api/performance/headers', name: 'get_performance_headers', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $dataResponse = ($this->getPerformanceHeadersService)();

        return new JsonResponse($this->serialize($dataResponse));
    }
}