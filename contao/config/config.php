<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopeProductMemberGroups extension.
 */

use Fenepedia\ContaoIsotopeProductMemberGroups\EventListener\Isotope\PostCheckout\AddMemberGroupsListener;

$GLOBALS['ISO_HOOKS']['postCheckout'][] = [AddMemberGroupsListener::class, '__invoke'];
