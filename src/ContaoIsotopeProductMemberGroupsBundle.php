<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopeProductMemberGroups extension.
 */

namespace Fenepedia\ContaoIsotopeProductMemberGroups;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoIsotopeProductMemberGroupsBundle extends Bundle
{
    public function getPath()
    {
        return \dirname(__DIR__);
    }
}
