<?php

namespace SendCloud\Checkout\API\Checkout\Delivery\Method;

use SendCloud\Checkout\DTO\DataTransferObject;

class ShippingRate extends DataTransferObject
{
    /**
     * @var string
     */
    protected $rate;
    /**
     * @var bool
     */
    protected $enabled;
    /**
     * @var bool
     */
    protected $isDefault;
    /**
     * @var int|null
     */
    protected $maxWeight;
    /**
     * @var int|null
     */
    protected $minWeight;

    /**
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param string $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return int|null
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param int|null $maxWeight
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;
    }

    /**
     * @return int|null
     */
    public function getMinWeight()
    {
        return $this->minWeight;
    }

    /**
     * @param int|null $minWeight
     */
    public function setMinWeight($minWeight)
    {
        $this->minWeight = $minWeight;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function toArray()
    {
        return array(
            'rate' => $this->getRate(),
            'enabled' => $this->isEnabled(),
            'is_default' => $this->isDefault(),
            'max_weight' => $this->getMaxWeight(),
            'min_weight' => $this->getMinWeight()
        );
    }

    /**
     * @param array $rawData
     *
     * @return ShippingRate|DataTransferObject
     */
    public static function fromArray(array $rawData)
    {
        return parent::fromArray($rawData);
    }

    /**
     * @param array $rawData
     *
     * @return DataTransferObject|static
     */
    protected static function instantiate(array $rawData)
    {
        $entity = new static();
        $entity->setRate(static::getValue($rawData, 'rate', '0'));
        $entity->setEnabled(static::getValue($rawData, 'enabled', false));
        $entity->setIsDefault(static::getValue($rawData, 'is_default', false));
        $entity->setMaxWeight(static::getValue($rawData, 'max_weight', null));
        $entity->setMinWeight(static::getValue($rawData, 'min_weight', null));

        return $entity;
    }
}
