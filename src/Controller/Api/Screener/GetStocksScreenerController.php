<?php

declare(strict_types=1);


namespace App\Controller\Api\Screener;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetFiltersListInformationStockDto;
use App\Dto\InformationStock\GetListInformationStockDto;
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

final class GetStocksScreenerController extends AppAbstractController
{
    public function __construct(
        private GetStocksScreenerService $getStocksScreenerService,
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
    #[Route(path: '/api/screener/stocks', name: 'get_stocks_screener')]
    public function __invoke(
        Request $request,
        #[MapQueryParameter] ?int $limit = 20,
        #[MapQueryParameter] ?int $page = 1,
        #[MapQueryParameter] ?string $sector = null,
        #[MapQueryParameter] ?string $marketCap = null,
        #[MapQueryParameter] ?string $per = null,
        #[MapQueryParameter] ?string $high52W = null
    ): Response
    {
        $filters = GetFiltersListInformationStockDto::create(
            sector: $sector,
            marketCap: $marketCap,
            per: $per,
            high52W: $high52W
        );

        $pageResponse = ($this->getStocksScreenerService)(
            GetListInformationStockDto::create(
                filters: $filters,
                page: $page,
                limit: $limit
            )
        );

        return new JsonResponse($this->serialize($pageResponse));
    }
}