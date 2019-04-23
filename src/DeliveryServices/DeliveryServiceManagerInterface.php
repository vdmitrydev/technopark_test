<?php
namespace App\DeliveryServices;

interface DeliveryServiceManagerInterface
{
    /**
     * Returns delivery service list: ['Bird', 'Turtle', ...]
     *
     * @return array
     */
    public function getServiceList(): array;
}