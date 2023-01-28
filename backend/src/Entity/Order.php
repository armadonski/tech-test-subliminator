<?php

declare(strict_types=1);

namespace App\Entity;

use App\Dto\OrderImportItemDto;
use App\Repository\OrderRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(name: '`date`', type: 'datetime')]
    private DateTime $date;

    #[ORM\Column(type: 'string', length: 255)]
    private string $customer;

    #[ORM\Column(type: 'string', length: 255)]
    private string $address;

    #[ORM\Column(type: 'string', length: 255)]
    private string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private string $postcode;

    #[ORM\Column(type: 'string', length: 255)]
    private string $country;

    #[ORM\Column(type: 'integer', length: 255)]
    private int $amount;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'string', length: 255)]
    private string $deleted;

    #[ORM\Column(name: 'last_modified', type: 'datetime', columnDefinition: "DATETIME on update CURRENT_TIMESTAMP")]
    private DateTime $lastModified;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Order
    {
        $this->id = $id;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Order
    {
        $this->date = $date;

        return $this;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): Order
    {
        $this->customer = $customer;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): Order
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Order
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): Order
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): Order
    {
        $this->country = $country;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): Order
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Order
    {
        $this->status = $status;

        return $this;
    }

    public function getDeleted(): string
    {
        return $this->deleted;
    }

    public function setDeleted(string $deleted): Order
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getLastModified(): DateTime
    {
        return $this->lastModified;
    }

    public function setLastModified(DateTime $lastModified): Order
    {
        $this->lastModified = $lastModified;

        return $this;
    }
}