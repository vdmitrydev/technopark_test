<?php
namespace App\DeliveryServices;

class DeliveryServiceFactory implements DeliveryServiceFactoryInterface
{
    public function make(string $name): DeliveryServiceInterface
    {
        $className = __NAMESPACE__ . '\\' . $name;

        return new $className;
    }
}