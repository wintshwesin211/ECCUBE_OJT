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

namespace Customize\Entity\Master;

use Doctrine\ORM\Mapping as ORM;

if (!class_exists('\Customize\Entity\Master\Calendar')) {
    /**
     * Calendar
     *
     * @ORM\Table(name="mtb_calendar")
     * @ORM\InheritanceType("SINGLE_TABLE")
     * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(repositoryClass="Customize\Repository\Master\CalendarRepository")
     */
    class Calendar extends \Eccube\Entity\AbstractEntity
    {
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="date", type="datetimetz")
         */
        private $date;

        /**
         * @var int
         *
         * @ORM\Column(name="week", type="smallint", options={"unsigned":true})
         */
        private $week;

        /**
         * @var int
         *
         * @ORM\Column(name="holiday", type="smallint", options={"unsigned":true})
         */
        private $holiday;

        /**
         * @var int
         *
         * @ORM\Column(name="factory_work_day", type="smallint", options={"unsigned":true})
         */
        private $factory_work_day;

        /**
         * @var int
         *
         * @ORM\Column(name="obic_day", type="smallint", options={"unsigned":true})
         */
        private $obic_day;

        /**
         * @var int
         *
         * @ORM\Column(name="onlineorder_alert_skip", type="smallint", options={"unsigned":true})
         */
        private $onlineorder_alert_skip;

        /**
         * @var int
         *
         * @ORM\Column(name="onlineorder_selectable_day", type="smallint", options={"unsigned":true})
         */
        private $onlineorder_selectable_day;

        /**
         * @var int
         *
         * @ORM\Column(name="is_businessday", type="smallint", options={"unsigned":true})
         */
        private $is_businessday;

        /**
         * Get id.
         *
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set date.
         *
         * @param string $date
         *
         * @return Calendar
         */
        public function setDate($date)
        {
            $this->date = $date;

            return $this;
        }

        /**
         * Get date.
         *
         * @return \DateTime
         */
        public function getDate()
        {
            return $this->date;
        }

        /**
         * Set week.
         *
         * @param string $week
         *
         * @return Calendar
         */
        public function setWeek($week)
        {
            $this->week = $week;

            return $this;
        }

        /**
         * Get week.
         *
         * @return int
         */
        public function getWeek()
        {
            return $this->week;
        }

        /**
         * Set holiday.
         *
         * @param int $holiday
         *
         * @return Calendar
         */
        public function setHoliday($holiday)
        {
            $this->holiday = $holiday;

            return $this;
        }

        /**
         * Get holiday.
         *
         * @return int
         */
        public function getHoliday()
        {
            return $this->holiday;
        }

        /**
         * Set factory work day.
         *
         * @param int $factory_work_day
         *
         * @return Calendar
         */
        public function setFactoryWorkDay($factory_work_day)
        {
            $this->factory_work_day = $factory_work_day;

            return $this;
        }

        /**
         * Get factory_work_day.
         *
         * @return int
         */
        public function getFactoryWorkDay()
        {
            return $this->factory_work_day;
        }

        /**
         * Set obic day.
         *
         * @param int $obic_day
         *
         * @return Calendar
         */
        public function setObicDay($obic_day)
        {
            $this->obic_day = $obic_day;

            return $this;
        }

        /**
         * Get obic day.
         *
         * @return int
         */
        public function getObicDay()
        {
            return $this->obic_day;
        }

        /**
         * Set onlineorder alert skip.
         *
         * @param int $onlineorder_alert_skip
         *
         * @return Calendar
         */
        public function setOnlineOrderAlettSkip($onlineorder_alert_skip)
        {
            $this->onlineorder_alert_skip = $onlineorder_alert_skip;

            return $this;
        }

        /**
         * Get onlineorder_alert_skip.
         *
         * @return int
         */
        public function getOnlineOrderAlettSkip()
        {
            return $this->onlineorder_alert_skip;
        }

        /**
         * Set Online Order Selectable Day.
         *
         * @param int $onlineorder_selectable_day
         *
         * @return Calendar
         */
        public function setOnlineOrderSelectableDay($onlineorder_selectable_day)
        {
            $this->onlineorder_selectable_day = $onlineorder_selectable_day;

            return $this;
        }

        /**
         * Get Online Order Selectable Day.
         *
         * @return int
         */
        public function getOnlineOrderSelectableDay()
        {
            return $this->onlineorder_selectable_day;
        }

        /**
         * Set is Business Day.
         *
         * @param int $is_businessday
         *
         * @return Calendar
         */
        public function setIsBusinessDay($is_businessday)
        {
            $this->is_businessday = $is_businessday;

            return $this;
        }

        /**
         * Get is Business Day.
         *
         * @return int
         */
        public function getIsBusinessDay()
        {
            return $this->is_businessday;
        }


    }
}
