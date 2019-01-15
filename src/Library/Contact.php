<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\ApiLayer ;


class Contact extends ApiLayer {


    public function addContactByForm( $arrForm, $arrValues ) {

        $arrData = [];
        $strFormId = $arrForm['id'];
        $objDatabase = \Database::getInstance();
        $objFields = $objDatabase->prepare('SELECT * FROM tl_form_field WHERE pid = ? AND invisible != ?')->execute( $strFormId, '1' );

        if ( !$objFields->numRows ) {

            return null;
        }

        while ( $objFields->next() ) {

            if ( $objFields->use_mautic && $objFields->mautic_role ) {

                $arrData[ $objFields->mautic_role ] = $arrValues[ $objFields->name ];
            }
        }

        $this->addContact( $arrData, [
            'addToSegment' => $arrForm['mautic_add_to_segment'],
            'segmentId' => $arrForm['mautic_add_to_segment']
        ]);
    }


    public function addContact( $arrData, $arrSettings = [] ) {

        $arrData['ipAddress'] = $_SERVER['REMOTE_ADDR'];

        $arrResult = $this->objApi->addContact( $arrData );

        if ( is_array( $arrResult ) && $arrSettings['addToSegment'] ) {

            $this->objApi->addSegment( $arrSettings['segmentId'], $arrResult['contact']['id'] );
        }
    }
}