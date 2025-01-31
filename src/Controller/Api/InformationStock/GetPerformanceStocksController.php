<?php

declare(strict_types=1);


namespace App\Controller\Api\InformationStock;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetFiltersListInformationStockDto;
use App\Dto\InformationStock\GetFiltersPerformanceInformationStockDto;
use App\Dto\InformationStock\GetListInformationStockDto;
use App\Dto\InformationStock\GetPerformanceInformationStockDto;
use App\Service\InformationStock\Performance\GetPerformanceStocksService;
use App\Service\Screener\GetStocksScreenerService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class GetPerformanceStocksController extends AppAbstractController
{
    public function __construct(
        private readonly GetPerformanceStocksService $getPerformanceStocksService,
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
    #[Route(path: '/api/performance/stocks', name: 'get_performance_stocks')]
    public function __invoke(
        Request $request,
        #[MapQueryParameter] ?int $limit = 20,
        #[MapQueryParameter] ?int $page = 1,
        #[MapQueryParameter] ?string $performanceCategory = null,
        #[MapQueryParameter] ?string $marketCap = null,
        #[MapQueryParameter] ?string $sector = null,
    ): Response
    {
        $filters = GetFiltersPerformanceInformationStockDto::create(
            performanceCategory: $performanceCategory,
            sector: $sector,
            marketCap: $marketCap,
        );

        $pageResponse = ($this->getPerformanceStocksService)(
            GetPerformanceInformationStockDto::create(
                filters: $filters,
                page: $page,
                limit: $limit
            )
        );

        return new JsonResponse($this->serialize($pageResponse));
    }
}