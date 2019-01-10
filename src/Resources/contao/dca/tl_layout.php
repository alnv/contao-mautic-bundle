<?php

$GLOBALS['TL_DCA']['tl_layout']['palettes']['__selector__'][] = 'use_mautic';

$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = str_replace( 'modules;', 'modules;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] );

$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['use_mautic'] = 'mautic_focus_item';

$GLOBALS['TL_DCA']['tl_layout']['fields']['use_mautic'] = [

    'label' => &$GLOBALS['TL_LANG']['tl_layout']['use_mautic'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_layout']['fields']['mautic_focus_item'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_layout']['mautic_focus_item'],
    'inputType' => 'select',
    'eval' => [
        'chosen' => true,
        'tl_class' => 'w50',
        'includeBlankOption' => true
    ],
    'options_callback' => [ 'mautic.datacontainer.options', 'getFocusItems' ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];