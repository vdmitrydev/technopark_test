<?php

use PHPUnit\Framework\TestCase;
use App\DeliveryServices\DeliveryServiceInterface;
use App\DeliveryCostCalculators\Adapters\BirdCostAdapter;
use App\Delivery;

class BirdCostAdapterTest extends TestCase
{
    public function testGetCostIfServiceReturnsErrorMessage()
    {
        $errorMessage = 'some error message';

        $serviceMock = $this->createMock(DeliveryServiceInterface::class);
        $serviceMock->method('calculate')
            ->willReturn($errorMessage);

        $deliveryMock = $this->createMock(Delivery::class);

        $adapter = new BirdCostAdapter($serviceMock);

        $this->assertNull($adapter->getCost($deliveryMock));
    }

    public function testGetCost()
    {
        $cost = 50;

        $serviceMock = $this->createMock(DeliveryServiceInterface::class);
        $serviceMock->method('calculate')
            ->willReturn(['cost' => $cost]);

        $deliveryMock = $this->createMock(Delivery::class);

        $adapter = new BirdCostAdapter($serviceMock);

        $this->assertEquals($cost, $adapter->getCost($deliveryMock));
    }
}