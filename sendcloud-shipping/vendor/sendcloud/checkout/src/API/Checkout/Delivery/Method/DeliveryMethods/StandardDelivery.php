<?php

namespace SendCloud\Checkout\API\Checkout\Delivery\Method\DeliveryMethods;

use SendCloud\Checkout\API\Checkout\Delivery\Method\Carrier;
use SendCloud\Checkout\API\Checkout\Delivery\Method\DeliveryMethod;
use SendCloud\Checkout\API\Checkout\Delivery\Method\Holiday;
use SendCloud\Checkout\API\Checkout\Delivery\Method\OrderPlacementDay;
use SendCloud\Checkout\API\Checkout\Delivery\Method\ShippingProduct;
use SendCloud\Checkout\DTO\DataTransferObject;

class StandardDelivery extends DeliveryMethod
{
    /**
     * @var Carrier
     */
    protected $carrier;

    /**
     * @var ShippingProduct
     */
    protected $shippingProduct;

    /**
     * @var OrderPlacementDay[]
     */
    private $orderPlacementDays;

    /**
     * @var Holiday[]
     */
    protected $holidays;

    /**
     * @return Carrier
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param Carrier $carrier
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    }

    /**
     * @return ShippingProduct
     */
    public function getShippingProduct()
    {
        return $this->shippingProduct;
    }

    /**
     * @param ShippingProduct $shippingProduct
     */
    public function setShippingProduct($shippingProduct)
    {
        $this->shippingProduct = $shippingProduct;
    }

    /**
     * @return OrderPlacementDay[]
     */
    public function getOrderPlacementDays()
    {
        return $this->orderPlacementDays;
    }

    /**
     * @param OrderPlacementDay[] $orderPlacementDays
     */
    public function setOrderPlacementDays($orderPlacementDays)
    {
        $this->orderPlacementDays = $orderPlacementDays;
    }

    /**
     * @return Holiday[]
     */
    public function getHolidays()
    {
        return $this->holidays;
    }

    /**
     * @param Holiday[] $holidays
     */
    public function setHolidays($holidays)
    {
        $this->holidays = $holidays;
    }

    /**
     * Provides array representation of a dto.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['carrier'] = $this->getCarrier()->toArray();
        $array['shipping_product'] = $this->getShippingProduct()->toArray();
        $array['order_placement_days'] = DataTransferObject::toArrayBatch($this->getOrderPlacementDays());

        if ($this->getHolidays()) {
            $array['holidays'] = DataTransferObject::toArrayBatch($this->getHolidays());
        }

        return $array;
    }

    /**
     * Set entity attributes from array
     *
     * @param array $rawData
     */
    protected function setEntityAttributes(array $rawData)
    {
        parent::setEntityAttributes($rawData);
        $this->setCarrier(Carrier::fromArray($rawData['carrier']));
        $this->setShippingProduct(ShippingProduct::fromArray($rawData['shipping_product']));
        /** @noinspection PhpParamsInspection */
        $this->setOrderPlacementDays(OrderPlacementDay::fromArrayBatch(static::getValue($rawData,
            'order_placement_days',
            array())));
        /** @noinspection PhpParamsInspection */
        $this->setHolidays(Holiday::fromArrayBatch(static::getValue($rawData, 'holidays', array())));
    }
}