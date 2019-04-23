<?php

use PHPUnit\Framework\TestCase;
use App\DeliveryServices\DeliveryServiceInterface;
use App\DeliveryCostCalculators\Adapters\TurtleCostAdapter;
use App\Delivery;
use App\DeliveryServices\Turtle;

class TurtleCostAdapterTest extends TestCase
{
    public function testGetCostIfServiceReturnsErrorMessage()
    {
        $errorMessage = 'some error message';

        $serviceMock = $this->createMock(DeliveryServiceInterface::class);
        $serviceMock->method('calculate')
            ->willReturn($errorMessage);

        $deliveryMock = $this->createMock(Delivery::class);

        $adapter = new TurtleCostAdapter($serviceMock);

        $this->assertNull($adapter->getCost($deliveryMock));
    }

    public function testGetCost()
    {
        $factor = 2;

        $serviceMock = $this->createMock(DeliveryServiceInterface::class);
        $serviceMock->method('calculate')
            ->willReturn(['factor' => $factor]);

        $deliveryMock = $this->createMock(Delivery::class);

        $adapter = new TurtleCostAdapter($serviceMock);

        $this->assertEquals($factor * Turtle::BASE_COST, $adapter->getCost($deliveryMock));
    }
}