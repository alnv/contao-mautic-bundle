<?php

namespace Alnv\MauticBundle\Library;


class View {


    public function getDoNotTrackForm() {

        $blnActiveTracking = !\Input::cookie('MAUTIC_DO_NOT_TRACK');

        $arrSettings = [
            'buttonLabel' => $blnActiveTracking ?
                $GLOBALS['TL_LANG']['MSC']['mautic_do_not_track_button_label'] :
                $GLOBALS['TL_LANG']['MSC']['mautic_track_button_label'],
            'id' => 'mautic_do_not_track_form',
            'action' => \Environment::get( 'indexFreeRequest' ),
            'buttonValue' => $blnActiveTracking ? 'disable' : 'enable'
        ];

        if ( \Input::post( 'mautic_do_not_track' ) ) {

            if ( \Input::post( 'mautic_do_not_track' ) == 'disable' ) {

                \System::setCookie( 'MAUTIC_DO_NOT_TRACK', '1', time() + 31536000 );

                $arrSettings['buttonLabel'] = $GLOBALS['TL_LANG']['MSC']['mautic_track_button_label'];
                $arrSettings['buttonValue'] = 'enable';
            }

            else {

                \System::setCookie( 'MAUTIC_DO_NOT_TRACK', '', time() );

                $arrSettings['buttonLabel'] = $GLOBALS['TL_LANG']['MSC']['mautic_do_not_track_button_label'];
                $arrSettings['buttonValue'] = 'disable';
            }

            if ( \Input::post('isAjax') ) {

                header('Content-Type: application/json');
                echo json_encode( $arrSettings, 512 );
                exit;
            }

            else {

                \Controller :: reload();
            }
        }

        $objTemplate = new \FrontendTemplate( 'mautic_doNotTrackForm' );
        $objTemplate->setData( $arrSettings );

        return $objTemplate->parse();
    }
}