<?php
namespace App\DeliveryServices;

class DeliveryServiceManager implements DeliveryServiceManagerInterface
{
    public function getServiceList(): array
    {
        $services = [];

        foreach (glob(__DIR__ .'/*.php') as $file) {
            $serviceName = basename($file, '.php');
            $className = __NAMESPACE__ . '\\' . $serviceName;

            if ($this->classIsDeliveryService($className)) {
                $services[] = $serviceName;
            }
        }

        return $services;
    }

    private function classIsDeliveryService($className): bool
    {
        return (new \ReflectionClass($className))->implementsInterface(DeliveryServiceInterface::class) &&
            $className != DeliveryServiceInterface::class;
    }
}