<?php

use PHPUnit\Framework\TestCase;
use App\DeliveryCostCalculators\Adapters\DeliveryCostAdapterFactoryInterface;
use App\DeliveryServices\DeliveryServiceFactoryInterface;
use App\DeliveryServices\DeliveryServiceManagerInterface;
use App\DeliveryCostCalculators\Adapters\DeliveryCostAdapter;
use App\DeliveryCostCalculators\DeliveryCostCalculator;
use App\Delivery;
use App\DeliveryServices\DeliveryServiceInterface;

class DeliveryCostCalculatorTest extends TestCase
{
    const COST = 50;
    const SERVICE_LIST = ['First', 'Second'];

    private $costAdapterMock;
    private $costAdapterFactoryMock;
    private $serviceManagerMock;
    private $serviceMock;
    private $serviceFactoryMock;
    private $deliveryMock;
    private $calculator;

    public function setUp()
    {
        $this->costAdapterMock = $this->createMock(DeliveryCostAdapter::class);
        $this->costAdapterMock->method('getCost')->willReturn(self::COST);

        $this->costAdapterFactoryMock = $this->createMock(DeliveryCostAdapterFactoryInterface::class);
        $this->costAdapterFactoryMock->method('make')->willReturn($this->costAdapterMock);

        $this->serviceManagerMock = $this->createMock(DeliveryServiceManagerInterface::class);
        $this->serviceManagerMock->method('getServiceList')->willReturn(self::SERVICE_LIST);

        $this->serviceMock = $this->createMock(DeliveryServiceInterface::class);

        $this->serviceFactoryMock = $this->createMock(DeliveryServiceFactoryInterface::class);
        $this->serviceFactoryMock->method('make')->willReturn($this->serviceMock);

        $this->deliveryMock = $this->createMock(Delivery::class);
        $this->calculator = new DeliveryCostCalculator($this->costAdapterFactoryMock, $this->serviceManagerMock, $this->serviceFactoryMock);
    }

    public function testGetCostWhenServiceIsObject()
    {
        $this->assertEquals(self::COST, $this->calculator->getCost($this->deliveryMock, $this->serviceMock));
    }

    public function testGetCostWhenServiceIsString()
    {
        $this->assertEquals(self::COST, $this->calculator->getCost($this->deliveryMock, 'some_delivery_service'));
    }

    public function testGetAllCosts()
    {
        $this->assertEquals(
            array_combine(
                self::SERVICE_LIST,
                array_fill(0, count(self::SERVICE_LIST), self::COST)
            ),
            $this->calculator->getAllCosts($this->deliveryMock)
        );
    }
}