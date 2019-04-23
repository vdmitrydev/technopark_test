<?php
namespace App\DeliveryCostCalculators\Adapters;

use App\Delivery;

class BirdCostAdapter extends DeliveryCostAdapter
{
    public function getCost(Delivery $delivery): ?int
    {
        $deliveryCalculation = $this->service->calculate($delivery);

        if (is_string($deliveryCalculation)) {
            return null;
        }

        return $deliveryCalculation['cost'];
    }
}