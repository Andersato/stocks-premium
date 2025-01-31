<?php

namespace App\Controller\Api;

use App\Response\AppResponseInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AppAbstractController extends AbstractController
{

    public function __construct(
        private ValidatorInterface $validator,
        private readonly SerializerInterface $serializer,
        private readonly TranslatorInterface $translator
    )
    {
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
    public function serialize(AppResponseInterface $response, ?string $translationDomain = null): array
    {
        $result = $this->serializer->serialize($response, 'json');
        $responseArray = json_decode($result, true, 512, JSON_THROW_ON_ERROR);

        if (null !== $translationDomain) {
            $responseArray = $this->translateKeys($responseArray, 'show');
        }

        return $responseArray;
    }

    /**
     * @throws \JsonException
     */
    public function serializeArray(array $response): array
    {
        $result = $this->serializer->serialize($response, 'json');

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }

    private function translateKeys(array $data, string $domain): array
    {
        $translated = [];
        foreach ($data as $key => $value) {
            $newKey = $this->translator->trans($key, [], $domain);
            if (is_array($value)) {
                $translated[$newKey] = $this->translateKeys($value, $domain);
            } else {
                $translated[$newKey] = $value;
            }
        }
        return $translated;
    }
}
