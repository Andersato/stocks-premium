<?php

namespace App\Controller\Api;

use App\Response\AppResponseInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AppAbstractController extends AbstractController
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

//    public function validate(ValidateDtoInterface $dto): void
//    {
//        /** @var ConstraintViolationList $errors */
//        $errors = $this->validator->validate($dto);
//        $errorMessages = [];
//
//        if (0 < count($errors)) {
//            foreach ($errors as $error) {
//                $errorMessages[] = [
//                    'field' => $error->getPropertyPath(),
//                    'message' => $error->getMessage(),
//                ];
//            }
//
//            throw new BadRequestException(json_encode($errorMessages));
//        }
//    }

    /**
     * @throws \JsonException
     */
    public function serialize(AppResponseInterface $response): array
    {
        $result = $this->serializer->serialize($response, 'json');

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws \JsonException
     */
    public function serializeArray(array $response): array
    {
        $result = $this->serializer->serialize($response, 'json');

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}
