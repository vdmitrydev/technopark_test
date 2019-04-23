<?php
namespace App\DeliveryCostCalculators\Adapters;

use App\DeliveryServices\DeliveryServiceInterface;

interface DeliveryCostAdapterFactoryInterface
{
    public function make(DeliveryServiceInterface $service): DeliveryCostAdapter;
}