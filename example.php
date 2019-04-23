<?php
require_once 'vendor/autoload.php';

$serviceFactory = new \App\DeliveryServices\DeliveryServiceFactory();
$serviceManager = new \App\DeliveryServices\DeliveryServiceManager();
$costAdapterFactory = new \App\DeliveryCostCalculators\Adapters\DeliveryCostAdapterFactory();
$costCalculator = new \App\DeliveryCostCalculators\DeliveryCostCalculator($costAdapterFactory, $serviceManager, $serviceFactory);

$delivery = new \App\Delivery('Moscow', 'London', [
    [
        'weight' => 20
    ],
    [
        'weight' => 40
    ],
]);

var_dump($costCalculator->getCost($delivery, 'Bird'));
var_dump($costCalculator->getAllCosts($delivery));