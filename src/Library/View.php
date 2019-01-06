<?php

namespace Alnv\MauticBundle\Library;


class View {


    public function getDoNotTrackForm() {

        $arrSettings = [

            'buttonLabel' => 'Bitte schließen Sie mich von der Mautic Zählung aus.',
            'id' => 'mautic_do_not_track_form',
            'buttonValue' => 'disable'
        ];

        if ( \Input::post( 'mautic_do_not_track' ) ) {

            if ( \Input::post( 'mautic_do_not_track' ) == 'disable' ) {

                \System::setCookie( 'MAUTIC_DO_NOT_TRACK', '1', time() + 31536000 );
            }

            else {

                \System::setCookie( 'MAUTIC_DO_NOT_TRACK', '' );
            }
        }

        $objTemplate = new \FrontendTemplate( 'mautic_doNotTrackForm' );
        $objTemplate->setData( $arrSettings );

        return $objTemplate->parse();
    }
}