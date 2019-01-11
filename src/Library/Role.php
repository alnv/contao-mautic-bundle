<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class Role {


    public function getRoles() {

        if ( \Cache::has('mautic_roles') ) {

            return \Cache::get('mautic_roles');
        }

        $arrReturn = [];
        $objApi = new Api();
        $arrRoles = $objApi->getRoles();

        if ( !is_array( $arrRoles ) ) {

            return null;
        }

        if ( !isset( $arrRoles['fields'] ) || !is_array( $arrRoles['fields'] ) ) {

            return null;
        }

        foreach ( $arrRoles['fields'] as $arrField ) {

            if ( $arrField['isPublished'] ) {

                $arrReturn[ $arrField['alias'] ] = $arrField['label'];
            }
        }

        \Cache::set( 'mautic_roles', $arrReturn );

        return $arrReturn;
    }
}