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

namespace Customize\Form\Extension\Shopping;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Eccube\Form\Type\Shopping\ShippingType;
use Customize\Repository\Master\CalendarRepository;

class ShippingExtension extends AbstractTypeExtension
{
    /**
     * @var CalendarRepository
     */
    protected $calendarRepository;

    /**
     * ShoppingController constructor.
     *
     * @param CalendarRepository $calendarRepository
     */
    public function __construct(
        CalendarRepository $calendarRepository
    ) {
        $this->calendarRepository = $calendarRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // お届け日のプルダウンを生成
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $Shipping = $event->getData();
                if (is_null($Shipping) || !$Shipping->getId()) {
                    return;
                }

                // お届け日の設定
                $minDate = 0;
                $deliveryDurationFlag = false;

                // 配送時に最大となる商品日数を取得
                foreach ($Shipping->getOrderItems() as $detail) {
                    $Product = $detail->getProduct();

                    if (is_null($Product)) {
                        continue;
                    }
                    $deliveryDate = $Product->getDeliveryDate();

                    if (is_null($deliveryDate)) {
                        continue;
                    }
                    if ($deliveryDate < 0) {
                        // 配送日数がマイナスの場合はお取り寄せなのでスキップする
                        $deliveryDurationFlag = false;
                        break;
                    }

                    if ($minDate < $deliveryDate) {
                        $minDate = $deliveryDate;
                    }

                    // 配送日数が設定されている
                    $deliveryDurationFlag = true;
                }

                // 配達最大日数期間を設定
                $deliveryDurations = [];

                // 配送日数が設定されている
                if ($deliveryDurationFlag) {

                    $NewDeliveryDate = new \DateTime('+' . $minDate . 'day');

                    $calendar = $this->calendarRepository->getCalendarDate($NewDeliveryDate);

                    // 曜日設定用
                    $dateFormatter = \IntlDateFormatter::create(
                        'ja_JP@calendar=japanese',
                        \IntlDateFormatter::FULL,
                        \IntlDateFormatter::FULL,
                        'Asia/Tokyo',
                        \IntlDateFormatter::TRADITIONAL,
                        'E'
                    );

                    foreach ($calendar as $day) {
                        $deliveryDurations[$day['date']->format('Y/m/d')] = $day['date']->format('Y/m/d') . '(' . $dateFormatter->format($day['date']) . ')';
                    }
                }

                $form = $event->getForm();
                $form
                    ->add(
                        'shipping_delivery_date',
                        ChoiceType::class,
                        [
                            'choices' => array_flip($deliveryDurations),
                            'required' => false,
                            'placeholder' => 'common.select__unspecified',
                            'mapped' => false,
                            'data' => $deliveryDurations,
                        ]
                    );
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return ShippingType::class;
    }

    /**
     * {@inheritdoc}
     */
    public static function getExtendedTypes(): iterable
    {
        yield ShippingType::class;
    }
}
