<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class Roles {


    protected $arrRoles = [];


    public function __construct() {

        $this->getRolesFromApi();
    }


    protected function getRolesFromApi() {

        if ( \Cache::has('mautic_roles') ) {

            $this->arrRoles = \Cache::get('mautic_roles');

            return null;
        }

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

                $this->arrRoles[ $arrField['alias'] ] = $arrField['label'];
            }
        }

        \Cache::set( 'mautic_roles', $this->arrRoles );
    }


    public function getRoles() {

        return $this->arrRoles;
    }
}