<?php

declare(strict_types=1);


namespace App\Controller\Api\Screener;

use App\Controller\Api\AppAbstractController;
use App\Dto\InformationStock\GetInformationStockMetricsDto;
use App\Service\InformationStock\Graphics\GetDataGraphicsByMetricsService;
use App\Service\InformationStock\List\GetTickerToAutocompleteService;
use App\Service\Screener\GetPersService;
use App\Service\Screener\GetSectorsService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class GetPersController extends AppAbstractController
{
   public function __construct(
       private readonly GetPersService $getPersService,
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
    #[Route(path: '/api/screener/pers', name: 'get_filter_pers', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {

        $dataResponse = ($this->getPersService)();

        return new JsonResponse($this->serializeArray($dataResponse));
    }
}