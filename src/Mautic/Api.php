<?php

namespace Alnv\MauticBundle\Mautic;

use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;


class Api {


    protected $strUrl = null;
    protected $objAuth = null;


    public function __construct( $arrSettings = [] ) {

        $arrSettings = [

            'userName' => \Config::get('mauticApiUser'),
            'password' => \Config::get('mauticApiPassword')
        ];

        if ( !\Config::get('mauticUseApi') ) {

            \System::log( 'Mautic Base URL is missing.', __METHOD__, TL_ERROR );

            return null;
        }

        if ( !\Config::get('mauticUseApi') ) {

            return null;
        }

        $objApiAuth = new ApiAuth();
        $this->strUrl = \Config::get('mauticHost');
        $this->objAuth = $objApiAuth->newAuth( $arrSettings, 'BasicAuth' );

        $objApi = new MauticApi();
        $objMauticVersion = $objApi->newApi('contacts', $this->objAuth, $this->strUrl );
        $objMauticVersion->getList( null, 0, 1 );

        if ( !$objMauticVersion->getMauticVersion() ) {

            \System::log( $GLOBALS['TL_LANG']['MSC']['mautic_invalid_access_log'], __METHOD__, TL_ERROR );

            \Message::addError( $GLOBALS['TL_LANG']['MSC']['mautic_invalid_access_log'] );
        }
    }


    public function addContact( $arrData ) {

        if ( !$this->objAuth ) {

            return null;
        }

        $objApi = new MauticApi();
        $objContactsApi = $objApi->newApi('contacts', $this->objAuth, $this->strUrl );

        return $objContactsApi->create( $arrData );
    }


    public function getContactFields() {

        if ( !$this->objAuth ) {

            return null;
        }

        if ( \Cache::has('mautic_contact_fields') ) {

            return \Cache::get('mautic_contact_fields');
        }

        $objApi = new MauticApi();
        $objContactFieldsApi = $objApi->newApi('contactFields', $this->objAuth, $this->strUrl );
        $arrContactFieldsList = $objContactFieldsApi->getList(null,0,0);

        \Cache::set( 'mautic_contact_fields', $arrContactFieldsList );

        return $arrContactFieldsList;
    }


    public function getCompaniesFields() {

        if ( !$this->objAuth ) {

            return null;
        }

        if ( \Cache::has('mautic_companies_fields') ) {

            return \Cache::get('mautic_companies_fields');
        }

        $objApi = new MauticApi();
        $objCompaniesFieldsApi = $objApi->newApi('companyFields', $this->objAuth, $this->strUrl );
        $arrCompaniesFieldsList = $objCompaniesFieldsApi->getList(null,0,0);

        \Cache::set( 'mautic_contact_fields', $arrCompaniesFieldsList );

        return $arrCompaniesFieldsList;
    }


    public function getFocusItemsList() {

        if ( !$this->objAuth ) {

            return null;
        }

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

        if ( !$this->objAuth ) {

            return null;
        }

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

        if ( !$this->objAuth ) {

            return null;
        }

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

        if ( !$this->objAuth ) {

            return null;
        }

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

        if ( !$this->objAuth ) {

            return null;
        }

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

        if ( !$this->objAuth ) {

            return null;
        }

        $objApi = new MauticApi();
        $objFormApi = $objApi->newApi('segments', $this->objAuth, $this->strUrl );

        return $objFormApi->addContact( $strSegmentId, $strContactId );
    }
}