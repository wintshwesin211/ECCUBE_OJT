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
     * @ORM\Column(name="delivery_date", type="datetimetz", nullable=true)
     */
    public $delivery_date;
}
