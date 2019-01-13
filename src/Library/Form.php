<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class Form {


    public function getForms() {

        $arrReturn = [];
        $objApi = new Api();
        $arrForms = $objApi->getForms();

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

        $objApi = new Api();
        $arrForm = $objApi->getForm( $strId );

        if ( !is_array( $arrForm ) ) {

            return '';
        }

        if ( !isset( $arrForm['form'] ) || !is_array( $arrForm['form'] ) ) {

            return '';
        }

        return $arrForm['form']['cachedHtml'];
    }
}