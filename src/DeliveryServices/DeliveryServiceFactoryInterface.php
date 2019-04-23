<?php
namespace App\DeliveryServices;

interface DeliveryServiceFactoryInterface
{
    public function make(string $name): DeliveryServiceInterface;
}