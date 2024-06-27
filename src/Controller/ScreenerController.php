<?php

declare(strict_types=1);


namespace App\Controller;

use App\Dto\InformationStock\GetFiltersListInformationStockDto;
use App\Dto\InformationStock\GetListInformationStockDto;
use App\Form\ScreenerFormModelType;
use App\Service\InformationStock\List\GetListInformationStockService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ScreenerController extends AbstractController
{
    private GetListInformationStockService $getListInformationStockService;

    public function __construct(GetListInformationStockService $getListInformationStockService)
    {
        $this->getListInformationStockService = $getListInformationStockService;
    }

    #[Route(path: '/screener', name: 'screener')]
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
        $form = $this->createForm(ScreenerFormModelType::class);
        $form->handleRequest($request);
        $filters = GetFiltersListInformationStockDto::create(
            sector: $sector,
            marketCap: $marketCap,
            per: $per,
            high52W: $high52W
        );

        $pageResponse = ($this->getListInformationStockService)(
            GetListInformationStockDto::create(
                filters: $filters,
                page: $page,
                limit: $limit
            )
        );

        return $this->render('list/index.html.twig', [
            'pageResponse' => $pageResponse,
            'screenerForm' => $form->createView(),
            'filters' => $filters
        ]);
    }
}