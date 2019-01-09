<?php

namespace Alnv\MauticBundle\Mautic;

use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;


class Api {


    protected $strUrl = null;
    protected $objAuth = null;


    public function __construct( $arrSettings = [] ) {

        // impl global mautic settings getter

        $arrSettings = [

            'userName' => \Config::get('mauticApiUser'),
            'password' => \Config::get('mauticApiPassword')
        ];

        if ( !\Config::get('mauticUseApi') ) {

            //@todo system log

            return null;
        }

        $objApiAuth = new ApiAuth();
        $this->strUrl = \Config::get('mauticHost');
        $this->objAuth = $objApiAuth->newAuth( $arrSettings, 'BasicAuth' );
    }


    public function addContact( $arrData ) {

        $objApi = new MauticApi();
        $objContactsApi = $objApi->newApi('contacts', $this->objAuth, $this->strUrl );

        return $objContactsApi->create( $arrData );
    }


    public function getRoles() {

        $objApi = new MauticApi();
        $objRolesApi = $objApi->newApi('contactFields', $this->objAuth, $this->strUrl );

        return $objRolesApi->getList(null,0,0);
    }
}