<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopeProductMemberGroups extension.
 */

namespace Fenepedia\ContaoIsotopeProductMemberGroups\EventListener\Isotope\PostOrderStatusUpdate;

use Contao\MemberModel;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;
use Isotope\Model\ProductCollection\Order;
use Isotope\Model\OrderStatus;
use Symfony\Component\Security\Core\Security;

class AddMemberGroupsListener
{
    public function __construct(
        private readonly Security $security,
        private readonly Connection $connection,
    ) {
    }

    public function __invoke(Order $order, int $oldStatus, OrderStatus $newStatus): void
    {

        if (!$newStatus->isPaid()) {
            return;
        }

        if (!$order->member) {
            return;
        }

        $member = MemberModel::findByPk($memberId);
        if (!($addGroups = $this->getMemberGroups($order))) {
            return;
        }

        $mergedGroups = array_unique(array_merge(self::processGroups($member->groups), $addGroups));
        $member->groups = $mergedGroups;
        $this->connection->update('tl_member', ['groups' => serialize($mergedGroups)], ['id' => $member->id]);
    }

    private function getMemberGroups(Order $order): array
    {
        $allGroups = [];

        foreach ($order->getItems() as $item) {
            $product = $item->getProduct();
            $allGroups = [...$allGroups, ...self::processGroups($product->addMemberGroups)];
            $allGroups = [...$allGroups, ...self::processGroups($product->getType()->addMemberGroups)];
        }

        return array_unique($allGroups);
    }

    private static function processGroups($serialized): array
    {
        if (!$serialized) {
            return [];
        }

        return array_filter(array_map('intval', StringUtil::deserialize($serialized, true)));
    }
}
