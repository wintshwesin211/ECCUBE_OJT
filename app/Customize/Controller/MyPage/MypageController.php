<?php

namespace Customize\Controller\MyPage;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\Mypage\MypageController as baseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class MypageController extends baseController
{
    /**
     * @Method("GET")
     * @Route("/receipt/{order_no}", name="receipt")
     * @Template("Mypage/receipt.twig")
     */
    public function receipt(Request $request, $order_no)
    {
        $this->entityManager->getFilters()
            ->enable('incomplete_order_status_hidden');
        $Order = $this->orderRepository->findOneBy(
            [
                'order_no' => $order_no,
                'Customer' => $this->getUser(),
            ]
        );

        $event = new EventArgs(
            [
                'Order' => $Order,
            ],
            $request
        );
        $this->eventDispatcher->dispatch(EccubeEvents::FRONT_MYPAGE_MYPAGE_HISTORY_INITIALIZE, $event);

        /** @var Order $Order */
        $Order = $event->getArgument('Order');

        if (!$Order) {
            throw new NotFoundHttpException();
        }

        $stockOrder = true;
        foreach ($Order->getOrderItems() as $orderItem) {
            if ($orderItem->isProduct() && $orderItem->getQuantity() < 0) {
                $stockOrder = false;
                break;
            }
        }

        return [
            'Order' => $Order,
            'stockOrder' => $stockOrder,
        ];
    }
}
