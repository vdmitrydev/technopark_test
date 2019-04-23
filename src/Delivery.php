<?php
namespace App;

class Delivery
{
    /**
     * @var string
     */
    protected $senderAddress;

    /**
     * @var string
     */
    protected $recipientAddress;

    /**
     * @var array
     */
    protected $items;

    public function __construct(string $senderAddress, string $recipientAddress, array $items)
    {
        $this->senderAddress = $senderAddress;
        $this->recipientAddress = $recipientAddress;
        $this->items = $items;
    }

    public function senderAddress(): string
    {
        return $this->senderAddress;
    }

    public function recipientAddress(): string
    {
        return $this->recipientAddress;
    }

    public function items(): array
    {
        return $this->items;
    }
}