<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['mautic_form'] = '{type_legend},type;{mautic_legend},mautic_form;{protected_legend:hide},protected;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['mautic_form'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['mautic_form'],
    'inputType' => 'select',
    'eval' => [
        'chosen' => true,
        'mandatory' => true,
        'tl_class' => 'w50',
        'includeBlankOption' => true
    ],
    'options_callback' => [ 'mautic.datacontainer.options', 'getForms' ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];