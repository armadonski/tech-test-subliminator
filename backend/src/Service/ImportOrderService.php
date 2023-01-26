<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\AnsiQuoteStrategy;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;
use JsonException;
use Symfony\Component\Finder\Finder;

class ImportOrderService
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function handle()
    {
        $finder = new Finder();
        $finder
            ->files()
            ->name('*.json')
            ->in('orderFiles');

        foreach ($finder as $file) {
            $fileContents = json_decode($file->getContents(), true, 512, JSON_THROW_ON_ERROR);

            foreach ($fileContents as $item) {
                $order = (new Order())
                    ->setId($item['id'])
                    ->setDate(new DateTime($item['date']))
                    ->setCustomer($item['customer'])
                    ->setAddress($item['address1'])
                    ->setCity($item['city'])
                    ->setPostcode($item['postcode'])
                    ->setCountry($item['country'])
                    ->setAmount($item['amount'])
                    ->setStatus($item['status'])
                    ->setDeleted($item['deleted'])
                    ->setLastModified(new DateTime($item['last_modified']));

                $this->entityManager->persist($order);

                $metadata = $this->entityManager->getClassMetaData(get_class($order));
                $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
            }
            try {
                $this->entityManager->flush();
            } catch (Exception $e) {
                var_dump($e->getMessage());
                die;
            }

        }
    }
}
