<?php

declare(strict_types=1);


namespace App\Controller\Api\InformationStock;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetListInformationStockDto;
use App\Exception\InformationStockNotFoundException;
use App\Service\InformationStock\About\GetStockAboutService;
use App\Service\InformationStock\GetInformationStockService;
use App\Service\InformationStock\List\GetListInformationStockService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class GetAboutStockController extends AppAbstractController
{
    public function __construct(
        private readonly GetStockAboutService $getStockAboutService,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        TranslatorInterface $translator
    )
    {
        parent::__construct($validator, $serializer, $translator);
    }

    /**
     * @throws InformationStockNotFoundException
     * @throws \JsonException
     */
    #[Route(path: '/api/stocks/about/{ticker}', name: 'get_stocks_about', methods: ['GET'])]
    public function __invoke(string $ticker): JsonResponse
    {
        $response = ($this->getStockAboutService)($ticker);

        return new JsonResponse($this->serialize($response, 'show'));
    }
}