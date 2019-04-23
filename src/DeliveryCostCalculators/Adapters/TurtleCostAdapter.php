<?php
namespace App\DeliveryCostCalculators\Adapters;

use App\Delivery;
use App\DeliveryServices\Turtle;

class TurtleCostAdapter extends DeliveryCostAdapter
{
    public function getCost(Delivery $delivery): ?int
    {
        $deliveryCalculation = $this->service->calculate($delivery);

        if (is_string($deliveryCalculation)) {
            return null;
        }

        return $deliveryCalculation['factor'] * Turtle::BASE_COST;
    }
}