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

$GLOBALS['TL_HOOKS']['generatePage'][] = [ 'Alnv\MauticBundle\Hooks\Page', 'onPageGeneration' ];
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = [ 'Alnv\MauticBundle\Hooks\Inserttag', 'parse' ];