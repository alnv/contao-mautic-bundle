<?php

$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace( 'fallback;', 'fallback;{mautic_legend},mautic_host,exclude_mautic;', $GLOBALS['TL_DCA']['tl_page']['palettes']['root'] );
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace( 'description;', 'description;{mautic_legend},exclude_mautic;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] );

$GLOBALS['TL_DCA']['tl_page']['fields']['exclude_mautic'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['exclude_mautic'],
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'w50 m12'
    ],
    'exclude' => true,
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_page']['fields']['mautic_host'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['mautic_host'],
    'inputType' => 'text',
    'eval' => [
        'rgxp' => 'url',
        'tl_class' => 'w50',
        'decodeEntities' => true
    ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];