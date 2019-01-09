<?php

$GLOBALS['TL_DCA']['tl_mautic_settings'] = [

    'config' => [

        'dataContainer' => 'File',
        'closed' => true,
    ],

    'palettes' => [

        '__selector__' => ['mauticUseApi'],
        'default' => '{general_settings},mauticHost;{api_settings},mauticUseApi;'
    ],

    'subpalettes' => [

        'mauticUseApi' => 'mauticApiUser,mauticApiPassword'
    ],

    'fields' => [

        'mauticHost' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticHost'],
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'url',
                'tl_class' => 'w50',
                'mandatory' => true,
                'decodeEntities' => true
            ]
        ],

        'mauticUseApi' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticUseApi'],
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true
            ]
        ],

        'mauticApiUser' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticApiUser'],
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'url',
                'tl_class' => 'w50',
                'mandatory' => true
            ]
        ],

        'mauticApiPassword' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticApiPassword'],
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'url',
                'hideInput' => true,
                'tl_class' => 'w50',
                'mandatory' => true
            ]
        ]
    ]
];