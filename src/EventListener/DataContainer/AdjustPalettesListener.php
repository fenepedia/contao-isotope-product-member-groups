<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopeProductMemberGroups extension.
 */

namespace Fenepedia\ContaoIsotopeProductMemberGroups\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

#[AsCallback('tl_iso_producttype', 'config.onload')]
class AdjustPalettesListener
{
    public function __invoke(DataContainer $dc): void
    {
        foreach ($GLOBALS['TL_DCA'][$dc->table]['palettes'] as $name => $palette) {
            if (!\is_string($palette)) {
                continue;
            }

            PaletteManipulator::create()
                ->addField('addMemberGroups', 'expert_legend', PaletteManipulator::POSITION_APPEND)
                ->applyToPalette($name, $dc->table)
            ;
        }
    }
}
