<?php

declare(strict_types=1);


namespace App\Controller\Api\InformationStock;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetInformationStockMetricsDto;
use App\Service\InformationStock\Graphics\GetDataGraphicsByMetricsService;
use App\Service\InformationStock\List\GetTickerToAutocompleteService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class GetTickersToAutocompleteController extends AppAbstractController
{
    private GetTickerToAutocompleteService $getTickerToAutocompleteService;

   public function __construct(
       GetTickerToAutocompleteService $getTickerToAutocompleteService,
       ValidatorInterface $validator,
       SerializerInterface $serializer
   )
   {
       $this->getTickerToAutocompleteService = $getTickerToAutocompleteService;
       parent::__construct($validator, $serializer);
   }


    /**
     * @throws \JsonException
     */
    #[Route(path: '/api/tickers-autocomplete', name: 'get_tickers_autocomplete', methods: ['GET'])]
    public function __invoke(
        #[MapQueryParameter] string $value
    ): JsonResponse
    {

        $dataResponse = ($this->getTickerToAutocompleteService)($value);

        return new JsonResponse($this->serializeArray($dataResponse));
    }
}