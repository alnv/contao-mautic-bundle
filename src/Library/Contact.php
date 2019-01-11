<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class Contact {


    protected $arrFormFields = [];
    protected $arrForm = [];
    protected $arrData = [];


    public function __construct( $arrForm, $arrValues ) {

        $this->arrForm = $arrForm;
        $strFormId = $arrForm['id'];
        $objDatabase = \Database::getInstance();
        $objFields = $objDatabase->prepare('SELECT * FROM tl_form_field WHERE pid = ? AND invisible != ?')->execute( $strFormId, '1' );

        if ( !$objFields->numRows ) {

            return null;
        }

        while ( $objFields->next() ) {

            if ( $objFields->use_mautic && $objFields->mautic_role ) {

                $this->arrData[ $objFields->mautic_role ] = $arrValues[ $objFields->name ];
            }
        }

        $this->arrData['ipAddress'] = $_SERVER['REMOTE_ADDR'];
    }


    public function addContact() {

        if ( empty( $this->arrData ) ) {

            return null;
        }

        $objApi = new Api();
        $arrResult = $objApi->addContact( $this->arrData );

        if ( is_array( $arrResult ) && $this->arrForm['mautic_add_to_segment'] ) {

            $objApi->addSegment( $this->arrForm['mautic_add_to_segment'], $arrResult['contact']['id'] );
        }
    }
}