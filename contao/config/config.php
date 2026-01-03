<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopeProductMemberGroups extension.
 */

use Fenepedia\ContaoIsotopeProductMemberGroups\EventListener\Isotope\PostOrderStatusUpdate\AddMemberGroupsListener;

$GLOBALS['ISO_HOOKS']['postOrderStatusUpdate'][] = [AddMemberGroupsListener::class, '__invoke'];
