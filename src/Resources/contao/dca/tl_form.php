<?php

$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'use_mautic';
$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] = str_replace( 'allowTags;', 'allowTags;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form']['palettes']['default'] );
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['use_mautic'] = 'mautic_create_contact';

$GLOBALS['TL_DCA']['tl_form']['fields']['use_mautic'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['use_mautic'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_form']['fields']['mautic_create_contact'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['mautic_create_contact'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr'
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];