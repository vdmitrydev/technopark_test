<?php
namespace App\DeliveryServices;

use App\Delivery;

class Bird implements DeliveryServiceInterface
{
    public function calculate(Delivery $delivery)
    {
        /**
         * Bird delivery service calculations example
         */

        if (!$delivery->items()) {
            return 'items list is empty';
        }

        return [
            'cost' => count($delivery->items()) * 10,
            'days' => count($delivery->items())
        ];
    }
}