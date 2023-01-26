<?php

declare(strict_types=1);

namespace App\Entity;

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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Order
     */
    public function setDate(DateTime $date): Order
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     * @return Order
     */
    public function setCustomer(string $customer): Order
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Order
     */
    public function setAddress(string $address): Order
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Order
     */
    public function setCity(string $city): Order
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     * @return Order
     */
    public function setPostcode(string $postcode): Order
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Order
     */
    public function setCountry(string $country): Order
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Order
     */
    public function setAmount(int $amount): Order
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Order
     */
    public function setStatus(string $status): Order
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeleted(): string
    {
        return $this->deleted;
    }

    /**
     * @param string $deleted
     * @return Order
     */
    public function setDeleted(string $deleted): Order
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastModified(): DateTime
    {
        return $this->lastModified;
    }

    /**
     * @param DateTime $lastModified
     * @return Order
     */
    public function setLastModified(DateTime $lastModified): Order
    {
        $this->lastModified = $lastModified;

        return $this;
    }
}