<?php
namespace App\DeliveryServices;

use App\Delivery;

interface DeliveryServiceInterface
{
    /**
     * Returns arbitrary data about delivery (cost, date etc.) or error message string
     *
     * @param Delivery $delivery
     * @return array|string
     */
    public function calculate(Delivery $delivery);
}