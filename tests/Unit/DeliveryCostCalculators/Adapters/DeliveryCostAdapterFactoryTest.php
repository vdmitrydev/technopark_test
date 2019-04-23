<?php

use PHPUnit\Framework\TestCase;
use App\DeliveryServices\DeliveryServiceInterface;
use App\DeliveryCostCalculators\Adapters\DeliveryCostAdapterFactory;
use App\Exceptions\DeliveryCostAdapterNotFound;
use App\DeliveryCostCalculators\Adapters\BirdCostAdapter;
use App\DeliveryCostCalculators\Adapters\TurtleCostAdapter;

class DeliveryCostAdapterFactoryTest extends TestCase
{
    /** @var  DeliveryCostAdapterFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new DeliveryCostAdapterFactory();
    }

    public function testMakeWithNonexistentService()
    {
        $this->expectException(DeliveryCostAdapterNotFound::class);
        
        $serviceMock = $this->getMockBuilder(DeliveryServiceInterface::class)
            ->setMockClassName('NonexistentDeliveryService')
            ->getMock();

        $this->factory->make($serviceMock);
    }

    public function testMakeBirdCostAdapter()
    {
        $serviceMock = $this->getMockBuilder(DeliveryServiceInterface::class)
            ->setMockClassName('Bird')
            ->getMock();


        $this->assertInstanceOf(BirdCostAdapter::class, $this->factory->make($serviceMock));
    }

    public function testMakeTurtleCostAdapter()
    {
        $serviceMock = $this->getMockBuilder(DeliveryServiceInterface::class)
            ->setMockClassName('Turtle')
            ->getMock();


        $this->assertInstanceOf(TurtleCostAdapter::class, $this->factory->make($serviceMock));
    }
}