<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use App\Exception\InvalidItemException;
use App\Validator\OrderImportValidator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use JsonException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class OrderImportService
{
    public const DIR_NAME = 'orderFiles';

    private FileFinderInterface $fileFinder;
    private OrderImportValidator $validator;
    private EntityManagerInterface $entityManager;

    public function __construct(
        FileFinderInterface $fileFinder,
        OrderImportValidator $validator,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ) {
        $this->fileFinder = $fileFinder;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
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

            $this->entityManager->beginTransaction();

            foreach ($deserializedOrders as $order) {
                $order = (new Order())->setDataFromDto($order);

                $this->entityManager->persist($order);

                $metadata = $this->entityManager->getClassMetaData(get_class($order));
                $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        }
    }
}
