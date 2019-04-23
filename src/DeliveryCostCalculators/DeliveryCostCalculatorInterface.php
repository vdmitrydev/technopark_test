<?php
namespace App\DeliveryCostCalculators;

use App\Delivery;
use App\DeliveryServices\DeliveryServiceInterface;

interface DeliveryCostCalculatorInterface
{
    /**
     * Get delivery cost for one specific delivery service
     *
     * @param Delivery $delivery
     * @param DeliveryServiceInterface|string $service Delivery service object or it's name
     * @return int|null
     */
    public function getCost(Delivery $delivery, $service): ?int;

    /**
     * Get delivery cost for all delivery services
     *
     * @param Delivery $delivery
     * @return array
     */
    public function getAllCosts(Delivery $delivery): array;
}