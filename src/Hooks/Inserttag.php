<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\View;


class Inserttag {


    public function parse( $strTag ) {

        $arrTags = explode( '::', $strTag );

        if ( !isset( $arrTags[0] ) ) {

            return false;
        }

        if ( $arrTags[0] !== 'mautic' ) {

            return false;
        }

        if ( isset( $arrTags[1] ) && $arrTags[1] == 'doNotTrackButton' ) {

            return $this->parseDoNotTrackButton();
        }

        return false;
    }


    protected function parseDoNotTrackButton() {

        $objView = new View();

        return $objView->getDoNotTrackForm();
    }
}