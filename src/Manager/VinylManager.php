<?php

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Vinyl;


class VinylManager
{

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUnitPrice(Vinyl $vinyl)
    {

        $vinylReducePrice = $vinyl->getReducePrice();
        if (empty($vinylReducePrice) || $vinylReducePrice === 0) {
            $unitPrice = $vinyl->getRegularPrice();
        } else {
            $unitPrice = $vinylReducePrice;
        }
        return $unitPrice;
    }
}
