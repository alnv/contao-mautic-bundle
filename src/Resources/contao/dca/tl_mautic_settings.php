<?php

$GLOBALS['TL_DCA']['tl_mautic_settings'] = [

    'config' => [

        'dataContainer' => 'File',
        'closed' => true,
        'onload_callback' => [
            [ 'mautic.datacontainer.settings', 'removeNewsletterPalette' ]
        ]
    ],

    'palettes' => [

        '__selector__' => ['mauticUseApi', 'mauticUseNewsletter', 'mauticCreateNewsletterContact' ],
        'default' => '{general_settings},mauticHost;{api_settings},mauticUseApi;{newsletter_settings},mauticUseNewsletter'
    ],

    'subpalettes' => [

        'mauticUseApi' => 'mauticApiUser,mauticApiPassword',
        'mauticUseNewsletter' => 'mauticCreateNewsletterContact',
        'mauticCreateNewsletterContact' => 'mauticAddSegmentOnRecipientActivation,mauticAddSegmentOnRemoveRecipient'
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
                'tl_class' => 'w50',
                'mandatory' => true
            ]
        ],

        'mauticUseNewsletter' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticUseNewsletter'],
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true
            ]
        ],

        'mauticCreateNewsletterContact' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticCreateNewsletterContact'],
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
                'submitOnChange' => true
            ],
        ],

        'mauticAddSegmentOnRecipientActivation' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticAddSegmentOnRecipientActivation'],
            'inputType' => 'select',
            'eval' => [
                'chosen' => true,
                'tl_class' => 'w50',
                'includeBlankOption' => true
            ],
            'options_callback' => [ 'mautic.datacontainer.options', 'getSegments' ]
        ],

        'mauticAddSegmentOnRemoveRecipient' => [
            'label' => &$GLOBALS['TL_LANG']['tl_mautic_settings']['mauticAddSegmentOnRemoveRecipient'],
            'inputType' => 'select',
            'eval' => [
                'chosen' => true,
                'tl_class' => 'w50',
                'includeBlankOption' => true
            ],
            'options_callback' => [ 'mautic.datacontainer.options', 'getSegments' ]
        ]
    ]
];