<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\ApiLayer;


class Form extends ApiLayer {


    public function getForms() {

        $arrReturn = [];
        $arrForms = $this->objApi->getForms();

        if ( !is_array( $arrForms ) ) {

            return null;
        }

        if ( !isset( $arrForms['forms'] ) || !is_array( $arrForms['forms'] ) ) {

            return null;
        }

        foreach ( $arrForms['forms'] as $arrForm ) {

            if ( $arrForm['isPublished'] ) {

                $arrReturn[ $arrForm['id'] ] = $arrForm['name'];
            }
        }

        return $arrReturn;
    }


    public function getFormTemplate( $strId ) {

        $arrForm = $this->objApi->getForm( $strId );

        if ( !is_array( $arrForm ) ) {

            return '';
        }

        if ( !isset( $arrForm['form'] ) || !is_array( $arrForm['form'] ) ) {

            return '';
        }

        return $arrForm['form']['cachedHtml'];
    }
}