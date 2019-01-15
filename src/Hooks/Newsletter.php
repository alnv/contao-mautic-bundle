<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Contact;


class Newsletter {


    public function activateRecipient( $strEmail ) {

        if ( !\Config::get('mauticUseNewsletter') ) {

            return null;
        }

        if ( !\Config::get('mauticCreateNewsletterContact') ) {

            return null;
        }

        $arrData = [
            'email' => $strEmail
        ];

        $objContact = new Contact();
        $objContact->addContact( $arrData, [
            'addToSegment' => \Config::get('mauticAddSegmentOnRecipientActivation') ? '1' : '',
            'segmentId' => \Config::get('mauticAddSegmentOnRecipientActivation')
        ]);
    }


    public function removeFromNewsletter( $strEmail ) {

        if ( !\Config::get('mauticUseNewsletter') ) {

            return null;
        }

        if ( !\Config::get('mauticCreateNewsletterContact') ) {

            return null;
        }

        $arrData = [
            'email' => $strEmail
        ];

        $objContact = new Contact();
        $objContact->addContact( $arrData, [
            'addToSegment' => \Config::get('mauticAddSegmentOnRemoveRecipient') ? '1' : '',
            'segmentId' => \Config::get('mauticAddSegmentOnRemoveRecipient')
        ]);
    }
}