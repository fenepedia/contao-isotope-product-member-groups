<?php

declare(strict_types=1);

/*
 * This file is part of the ContaoIsotopeProductMemberGroups extension.
 */

$GLOBALS['TL_DCA']['tl_iso_producttype']['fields']['addMemberGroups'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'foreignKey' => 'tl_member_group.name',
    'eval' => ['multiple' => true, 'tl_class' => 'clr'],
    'sql' => ['type' => 'blob', 'length' => 65535, 'notnull' => false],
    'attributes' => ['legend' => 'expert_legend'],
    'relation' => ['type' => 'hasMany', 'load' => 'lazy'],
];
