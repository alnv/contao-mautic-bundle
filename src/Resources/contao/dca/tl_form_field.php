<?php

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'use_mautic';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['hidden'] = str_replace( 'rgxp;', 'rgxp;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['hidden'] );
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['radio'] = str_replace( 'options;', 'options;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['radio'] );
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['select'] = str_replace( 'options;', 'options;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['select'] );
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['text'] = str_replace( 'placeholder;', 'placeholder;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['text'] );
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['checkbox'] = str_replace( 'options;', 'options;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['checkbox'] );
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['textarea'] = str_replace( 'placeholder;', 'placeholder;{mautic_legend},use_mautic;', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['textarea'] );

$GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['use_mautic'] = 'mautic_role';

$GLOBALS['TL_DCA']['tl_form_field']['fields']['use_mautic'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form_field']['use_mautic'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'clr',
        'submitOnChange' => true
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['mautic_role'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form_field']['mautic_role'],
    'inputType' => 'select',
    'eval' => [
        'chosen' => true,
        'tl_class' => 'w50',
        'includeBlankOption' => true
    ],
    'options_callback' => [ 'mautic.datacontainer.options', 'getRoles' ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];