<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\ApiLayer;


class Role extends ApiLayer {


    public function getRoles() {

        $arrReturn = [];
        $arrContactFields = $this->objApi->getContactFields();

        if ( !is_array( $arrContactFields ) ) {

            return null;
        }

        if ( !isset( $arrContactFields['fields'] ) || !is_array( $arrContactFields['fields'] ) ) {

            return null;
        }

        foreach ( $arrContactFields['fields'] as $arrField ) {

            if ( $arrField['isPublished'] ) {

                $arrReturn[ $arrField['alias'] ] = $arrField['label'];
            }
        }

        // @todo add companies roles

        return $arrReturn;
    }
}