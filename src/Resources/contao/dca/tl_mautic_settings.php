<?php

$GLOBALS['TL_DCA']['tl_mautic_settings'] = [

    'config' => [

        'dataContainer' => 'File',
        'closed' => true,
    ],

    'palettes' => [

        'default' => '{general_settings},mauticHost;'
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
        ]
    ]
];