<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class OrderDTO extends DataTransferObject
{
    public string $name;
    public string $lastName;
    public string $phone;
    public string $email;
    public string $city;
    public string $address;
    public string $paymentMethod;
    public ?bool $pickup;
    public ?string $promocode;
    public ?string $password;
    public ?int $totalPrice;
}
