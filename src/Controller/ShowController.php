<?php

declare(strict_types=1);


namespace App\Controller;

use App\Dto\InformationStock\GetListInformationStockDto;
use App\Exception\InformationStockNotFoundException;
use App\Service\InformationStock\GetInformationStockService;
use App\Service\InformationStock\List\GetListInformationStockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ShowController extends AbstractController
{
    private GetInformationStockService $getInformationStockService;

    public function __construct(GetInformationStockService $getInformationStockService)
    {
        $this->getInformationStockService = $getInformationStockService;
    }

    /**
     * @throws InformationStockNotFoundException
     */
    #[Route(path: '/show/{ticker}', name: 'show_stock')]
    public function __invoke(string $ticker): Response
    {
        $informationStock = ($this->getInformationStockService)($ticker);

        return $this->render('show/show.html.twig', [
            'informationStock' => $informationStock,

        ]);
    }
}