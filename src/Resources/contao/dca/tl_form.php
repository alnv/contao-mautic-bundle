<?php

$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'use_mautic';
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'mautic_add_to_segment';

$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] = str_replace( 'allowTags;', 'allowTags;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form']['palettes']['default'] );

$GLOBALS['TL_DCA']['tl_form']['subpalettes']['use_mautic'] = 'mautic_create_contact,mautic_add_to_segment';
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['mautic_add_to_segment'] = 'mautic_segment';

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

$GLOBALS['TL_DCA']['tl_form']['fields']['mautic_add_to_segment'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['mautic_add_to_segment'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_form']['fields']['mautic_segment'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['mautic_segment'],
    'inputType' => 'select',
    'eval' => [
        'chosen' => true,
        'mandatory' => true,
        'tl_class' => 'w50',
        'includeBlankOption' => true
    ],
    'options_callback' => [ 'mautic.datacontainer.options', 'getSegments' ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];