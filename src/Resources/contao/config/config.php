<?php

array_insert( $GLOBALS['BE_MOD'], 4, [

    'mautic-bundle' => [

        'mautic-settings' => [

            'name' => 'mautic-settings',
            'tables' => [

                'tl_mautic_settings'
            ]
        ]
    ]
]);

array_insert( $GLOBALS['TL_CTE'], 4, [

    'mautic' => [

        'mautic_form' => 'Alnv\MauticBundle\Elements\ContentMauticForm'
    ]
]);

$GLOBALS['TL_HOOKS']['generatePage'][] = [ 'Alnv\MauticBundle\Hooks\Page', 'onPageGeneration' ];
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = [ 'Alnv\MauticBundle\Hooks\Inserttag', 'parse' ];
$GLOBALS['TL_HOOKS']['processFormData'][] = [ 'Alnv\MauticBundle\Hooks\Form', 'process' ];

// $GLOBALS['TL_HOOKS']['createNewUser'][] = [ '', '' ]; // new user
// $GLOBALS['TL_HOOKS']['closeAccount'][] = [ '', '' ]; // delete user
// $GLOBALS['TL_HOOKS']['activateRecipient'][] = [ '', '' ]; // newsletter add
// $GLOBALS['TL_HOOKS']['removeRecipient'][] = [ '', '' ]; // newsletter remove