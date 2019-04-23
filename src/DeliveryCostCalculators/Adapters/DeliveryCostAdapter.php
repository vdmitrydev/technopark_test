<?php
namespace App\DeliveryCostCalculators\Adapters;

use App\Delivery;
use App\DeliveryServices\DeliveryServiceInterface;

abstract class DeliveryCostAdapter
{
    protected $service;

    public function __construct(DeliveryServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Returns the cost of delivery or null if delivery service returned error
     *
     * @param Delivery $delivery
     * @return int|null
     */
    abstract public function getCost(Delivery $delivery): ?int;
}