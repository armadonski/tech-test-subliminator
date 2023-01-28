<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\InvalidItemException;
use App\Repository\OrderRepositoryInterface;
use App\Validator\OrderImportValidator;
use JsonException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class OrderImportService
{
    public const DIR_NAME = 'orderFiles';

    public function __construct(
        private readonly OrderImportValidator $validator,
        private readonly FileFinderInterface $fileFinder,
        private readonly OrderRepositoryInterface $orderRepository
    ) {
    }

    /**
     * @throws JsonException
     * @throws InvalidItemException
     */
    public function handle(): void
    {
        $nameConverter = new CamelCaseToSnakeCaseNameConverter();
        $normalizer = new ObjectNormalizer(
            null,
            $nameConverter
        );

        $serializer = new Serializer(
            [$normalizer, new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        $files = $this->fileFinder->findJsonFiles(self::DIR_NAME);

        foreach ($files as $file) {
            $fileContents = $file->getContents();
            $deserializedOrders = $serializer->deserialize(
                $fileContents,
                'App\Dto\OrderImportItemDto[]',
                'json'
            );

            $this->validator->validateContents($deserializedOrders);

            $this->orderRepository->insertMultiple($deserializedOrders);
        }
    }
}
