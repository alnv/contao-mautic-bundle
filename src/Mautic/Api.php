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

        if ( \Cache::has('mautic_roles') ) {

            return \Cache::get('mautic_roles');
        }

        $objApi = new MauticApi();
        $objRolesApi = $objApi->newApi('contactFields', $this->objAuth, $this->strUrl );
        $arrRolesList = $objRolesApi->getList(null,0,0);

        \Cache::set( 'mautic_roles', $arrRolesList );

        return $arrRolesList;
    }


    public function getFocusItemsList() {

        if ( \Cache::has('mautic_focus_items') ) {

            return \Cache::get('mautic_focus_items');
        }

        $objApi = new MauticApi();
        $objFocusItemApi = $objApi->newApi('focus', $this->objAuth, $this->strUrl );
        $arrFocusItemList =  $objFocusItemApi->getList(null, 0,0 );

        \Cache::set( 'mautic_focus_items', $arrFocusItemList );

        return $arrFocusItemList;
    }


    public function getFocusItem( $strId ) {

        if ( \Cache::has( 'mautic_focus_item' . $strId ) ) {

            return \Cache::get( 'mautic_focus_item' . $strId );
        }

        $objApi = new MauticApi();
        $objFocusItemApi = $objApi->newApi('focus', $this->objAuth, $this->strUrl );
        $arrFocusItem = $objFocusItemApi->get( $strId );

        \Cache::set( 'mautic_focus_item' . $strId, $arrFocusItem );

        return $arrFocusItem;
    }


    public function getForms() {

        if ( \Cache::has('mautic_forms') ) {

            return \Cache::get('mautic_forms');
        }

        $objApi = new MauticApi();
        $objFormApi = $objApi->newApi('forms', $this->objAuth, $this->strUrl );
        $arrFormList = $objFormApi->getList(null, 0,0 );

        \Cache::set( 'mautic_forms', $arrFormList );

        return $arrFormList;
    }


    public function getForm( $strId ) {

        if ( \Cache::has( 'mautic_form_' . $strId ) ) {

            return \Cache::get( 'mautic_form_' . $strId );
        }

        $objApi = new MauticApi();
        $objFormApi = $objApi->newApi('forms', $this->objAuth, $this->strUrl );
        $arrForm = $objFormApi->get( $strId );

        \Cache::set( 'mautic_form_' . $strId, $arrForm );

        return $arrForm;
    }


    public function getSegments() {

        if ( \Cache::has('mautic_segments') ) {

            return \Cache::get('mautic_segments');
        }

        $objApi = new MauticApi();
        $objSegmentApi = $objApi->newApi('segments', $this->objAuth, $this->strUrl );
        $arrSegment = $objSegmentApi->getList(null, 0,0 );

        \Cache::set( 'mautic_segments', $arrSegment );

        return $arrSegment;
    }


    public function addSegment( $strSegmentId, $strContactId ) {

        $objApi = new MauticApi();
        $objFormApi = $objApi->newApi('segments', $this->objAuth, $this->strUrl );

        return $objFormApi->addContact( $strSegmentId, $strContactId );
    }
}