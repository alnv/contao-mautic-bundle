<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class Contact {


    protected $arrFormFields = [];
    protected $arrData = [];


    public function addContact() {

        if ( empty( $this->arrData ) ) {

            return null;
        }

        $objApi = new Api();
        $objApi->addContact( $this->arrData );
    }


    public function addForm( $strFormId, $arrValues ) {

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
}