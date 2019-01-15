<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Contact;


class Comment {


    public function addComment( $strCommentId, $arrSet, $objModule ) {

        if ( !$objModule->use_mautic ) {

            return null;
        }

        if ( !$objModule->mautic_create_contact ) {

            return null;
        }

        if ( !$arrSet['email'] ) {

            return null;
        }

        $arrSettings = [
            'addToSegment' => $objModule->mautic_add_to_segment,
            'segmentId' => $objModule->mautic_segment
        ];

        $objContact = new Contact();
        $objContact->addContact( ['email' => $arrSet['email'] ], $arrSettings );
    }
}