<?php

namespace SendCloud\Checkout\Domain\Delivery\Availability\AvailabilityPolicy;

use SendCloud\Checkout\Domain\Delivery\Availability\AvailabilityPolicy;
use SendCloud\Checkout\Domain\Delivery\Availability\Order;
use SendCloud\Checkout\Domain\Delivery\DeliveryMethod;

class CompositeAvailabilityPolicy extends AvailabilityPolicy
{
    /**
     * @var AvailabilityPolicy[]
     */
    protected $subPolices;

    /**
     * @param DeliveryMethod $deliveryMethod
     * @param Order $order
     * @param array $subPolices
     */
    public function __construct(DeliveryMethod $deliveryMethod, Order $order, array $subPolices)
    {
        parent::__construct($deliveryMethod, $order);
        $this->subPolices = $subPolices;
    }

    /**
     * @inheritDoc
     */
    public function isAvailable()
    {
        foreach ($this->subPolices as $subPolicy) {
            if (!$subPolicy->isAvailable()) {
                return false;
            }
        }

        return  true;
    }
}
