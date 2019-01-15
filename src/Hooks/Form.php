<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Contact;


class Form {


    public function process( $arrPost, $arrForm, $arrFiles ) {

        if ( !$arrForm['use_mautic'] || !$arrForm['mautic_create_contact']  ) {

            return null;
        }

        $objContact = new Contact();
        $objContact->addContactByForm( $arrForm, $arrPost );
    }
}