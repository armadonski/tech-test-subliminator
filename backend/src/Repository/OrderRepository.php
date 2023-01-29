<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\OrderImportItemDto;
use App\Entity\Order;
use App\Exception\InvalidStatusException;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function get(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->where('o.deleted = :deletedStatus')
            ->orderBy('o.id', 'desc')
            ->setParameter('deletedStatus', 'No');
    }

    /**
     * @throws Exception
     * @var OrderImportItemDto[] $orderDtos
     */
    public function insertMultiple(array $orderDtos): void
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        try {
            foreach ($orderDtos as $order) {
                $orderEntity = $this->setDataFromDto($order);

                $em->persist($orderEntity);

                $metadata = $em->getClassMetaData(get_class($orderEntity));
                $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_NONE);
                $metadata->setIdGenerator(new AssignedGenerator());
            }

            $em->flush();
            $em->commit();
        } catch (Exception $exception) {
            $em->rollback();

            throw $exception;
        }
    }

    private function setDataFromDto(OrderImportItemDto $dto): Order
    {
        return (new Order())
            ->setId($dto->getId())
            ->setDate(new DateTime($dto->getDate()))
            ->setCustomer($dto->getCustomer())
            ->setAddress($dto->getAddress1())
            ->setCity($dto->getCity())
            ->setPostcode($dto->getPostcode())
            ->setCountry($dto->getCountry())
            ->setAmount($dto->getAmount())
            ->setStatus($dto->getStatus())
            ->setDeleted($dto->getDeleted())
            ->setLastModified(new DateTime($dto->getLastModified()));
    }

    public function updateStatus(Order $order, string $status): void
    {
        if (Order::STATUS_PENDING !== $order->getStatus()) {
            throw new InvalidStatusException();
        }

        $em = $this->getEntityManager();

        $order->setStatus($status);
        $em->persist($order);
        $em->flush();
    }
}
