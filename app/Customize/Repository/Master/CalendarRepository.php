<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Repository\Master;

use Carbon\Carbon;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Customize\Entity\Master\Calendar;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Eccube\Repository\AbstractRepository;

/**
 * CalendarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CalendarRepository extends AbstractRepository
{
    /**
     * CalendarRepository constructor.
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Calendar::class);
    }

    /**
     * @param int $id
     *
     * @return Calendar
     * @throws \Exception
     */
    public function get($id = 1)
    {
        $calendar = $this->find($id);

        if (null === $calendar) {
            throw new \Exception('Calendar not found. id = '.$id);
        }

        return $calendar;
    }

    /**
     * getListOrderByIdDesc
     *
     * @return array|null
     */
    public function getListOrderByIdDesc()
    {
        $qb = $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * getCalendarDate
     *
     * @param $deliveryDate
     *
     * @return array|null
     */
    public function getCalendarDate($deliveryDate)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.date')
            ->andWhere('c.date >= :period')
            ->setParameter(':period', $deliveryDate);

        return $qb
            ->getQuery()
            ->getResult();
    }
}