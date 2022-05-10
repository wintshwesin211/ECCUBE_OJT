<?php

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

/**
 * @EntityExtension("Eccube\Entity\Product")
 */
trait ProductTrait
{
    /**
     * @var \DateTime|null
     * 
     * @ORM\Column(name="delivery_date", type="integer", nullable=true)
     */
    public $delivery_date;

    /**
     * Set delivery date.
     *
     * @param string $delivery_date
     *
     * @return Product
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    /**
     * Get delivery date.
     *
     * @return int
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }
}
