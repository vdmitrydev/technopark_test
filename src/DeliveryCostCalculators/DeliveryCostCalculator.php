<?php
namespace App\DeliveryCostCalculators;

use App\Delivery;
use App\DeliveryCostCalculators\Adapters\DeliveryCostAdapterFactoryInterface;
use App\DeliveryServices\DeliveryServiceFactoryInterface;
use App\DeliveryServices\DeliveryServiceManagerInterface;

class DeliveryCostCalculator implements DeliveryCostCalculatorInterface
{
    private $costAdapterFactory;
    private $serviceManager;
    private $serviceFactory;

    public function __construct(
        DeliveryCostAdapterFactoryInterface $costAdapterFactory,
        DeliveryServiceManagerInterface $serviceManager,
        DeliveryServiceFactoryInterface $serviceFactory
    ) {
        $this->costAdapterFactory = $costAdapterFactory;
        $this->serviceManager = $serviceManager;
        $this->serviceFactory = $serviceFactory;
    }

    public function getCost(Delivery $delivery, $service): ?int
    {
        if (is_string($service)) {
            $service = $this->serviceFactory->make($service);
        }

        $costAdapter = $this->costAdapterFactory->make($service);

        return $costAdapter->getCost($delivery);
    }

    public function getAllCosts(Delivery $delivery): array
    {
        $costs = [];
        $services = $this->serviceManager->getServiceList();

        foreach ($services as $serviceName) {
            $service = $this->serviceFactory->make($serviceName);
            $costAdapter = $this->costAdapterFactory->make($service);
            $costs[$serviceName] = $costAdapter->getCost($delivery);
        }

        return $costs;
    }
}