<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Contact;
use Alnv\MauticBundle\Library\Role;


class Registration {


    public function createNewUser( $objUserId, $arrSubmit, $objModule ) {

        if ( !$objModule->use_mautic ) {

            return null;
        }

        if ( !$objModule->mautic_create_contact ) {

            return null;
        }

        $arrSettings = [
            'addToSegment' => $objModule->mautic_add_to_segment,
            'segmentId' => $objModule->mautic_segment
        ];

        $this->createContact( $arrSubmit, $arrSettings );
    }


    public function closeAccount( $objUserId, $stAct, $objModule ) {

        if ( !$objModule->use_mautic ) {

            return null;
        }

        if ( !$objModule->mautic_create_contact ) {

            return null;
        }

        if ( !FE_USER_LOGGED_IN ) {

            return null;
        }

        $arrSettings = [
            'addToSegment' => $objModule->mautic_add_to_segment,
            'segmentId' => $objModule->mautic_segment
        ];

        $objUser = \FrontendUser::getInstance();
        $this->createContact( $objUser->getData(), $arrSettings );
    }


    protected function createContact( $arrSubmit, $arrSettings ) {

        $arrData = [];
        $objRole = new Role();
        $arrRoles = $objRole->getRoles();

        if ( !is_array( $arrRoles ) || empty( $arrRoles ) ) {

            return null;
        }

        foreach ( $arrRoles as $strName => $strValue ) {

            $strSystemName = $GLOBALS['MAUTIC']['PARAMETERS'][ $strName ] ?: $strName;

            if ( $arrSubmit[ $strSystemName ] != null || $arrSubmit[ $strSystemName ] != '' ) {

                $arrData[ $strName ] = $arrSubmit[ $strSystemName ];
            }
        }

        $objContact = new Contact();
        $objContact->addContact( $arrData, $arrSettings );
    }
}