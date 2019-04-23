<?php
namespace App\DeliveryCostCalculators\Adapters;

use App\DeliveryServices\DeliveryServiceInterface;
use App\Exceptions\DeliveryCostAdapterNotFound;

class DeliveryCostAdapterFactory implements DeliveryCostAdapterFactoryInterface
{
    public function make(DeliveryServiceInterface $service): DeliveryCostAdapter
    {
        $className = __NAMESPACE__ . '\\' . (new \ReflectionClass($service))->getShortName() . 'CostAdapter';

        if (!class_exists($className)) {
            throw new DeliveryCostAdapterNotFound("Delivery cost adapter $className not found");
        }

        return new $className($service);
    }
}