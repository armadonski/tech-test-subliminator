<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class OrderImportItemDto
{
    #[Assert\Type(type: 'integer')]
    #[Assert\Positive]
    private mixed $id;

    #[Assert\DateTime]
    private mixed $date;

    #[Assert\Type(type: 'string')]
    private mixed $customer;

    #[Assert\Type(type: 'string')]
    private mixed $address1;

    #[Assert\Type(type: 'string')]
    private mixed $city;

    #[Assert\Type(type: 'string')]
    private mixed $postcode;

    #[Assert\Type(type: 'string')]
    private mixed $country;

    #[Assert\Type(type: 'int')]
    private mixed $amount;

    #[Assert\Type(type: 'string')]
    private mixed $status;

    #[Assert\Type(type: 'string')]
    private mixed $deleted;

    #[Assert\DateTime]
    private mixed $lastModified;

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): OrderImportItemDto
    {
        $this->id = $id;

        return $this;
    }

    public function getDate(): mixed
    {
        return $this->date;
    }

    public function setDate(mixed $date): OrderImportItemDto
    {
        $this->date = $date;

        return $this;
    }

    public function getCustomer(): mixed
    {
        return $this->customer;
    }

    public function setCustomer(mixed $customer): OrderImportItemDto
    {
        $this->customer = $customer;

        return $this;
    }

    public function getAddress1(): mixed
    {
        return $this->address1;
    }

    public function setAddress1(mixed $address1): OrderImportItemDto
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getCity(): mixed
    {
        return $this->city;
    }

    public function setCity(mixed $city): OrderImportItemDto
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): mixed
    {
        return $this->postcode;
    }

    public function setPostcode(mixed $postcode): OrderImportItemDto
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCountry(): mixed
    {
        return $this->country;
    }

    public function setCountry(mixed $country): OrderImportItemDto
    {
        $this->country = $country;

        return $this;
    }

    public function getAmount(): mixed
    {
        return $this->amount;
    }

    public function setAmount(mixed $amount): OrderImportItemDto
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): mixed
    {
        return $this->status;
    }

    public function setStatus(mixed $status): OrderImportItemDto
    {
        $this->status = $status;

        return $this;
    }

    public function getDeleted(): mixed
    {
        return $this->deleted;
    }

    public function setDeleted(mixed $deleted): OrderImportItemDto
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getLastModified(): mixed
    {
        return $this->lastModified;
    }

    public function setLastModified(mixed $lastModified): OrderImportItemDto
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    public function serialize(): string
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

        return (new Serializer([$normalizer], [new JsonEncoder()]))->serialize($this, 'json');
    }
}
