<?php
namespace App\DeliveryServices;

use App\Delivery;

class Turtle implements DeliveryServiceInterface
{
    const BASE_COST = 150;

    public function calculate(Delivery $delivery)
    {
        /**
         * Turtle delivery service calculations example
         */

        if (!$delivery->items()) {
            return 'items list is empty';
        }

        return [
            'factor' => count($delivery->items()),
            'date' => date('Y-m-d', time() + count($delivery->items()) * 24 * 60 * 60)
        ];
    }
}