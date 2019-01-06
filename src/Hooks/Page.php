<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\PageWizard;
use Alnv\MauticBundle\Library\TrackingScript;


class Page {


    public function onPageGeneration( \PageModel $objPage, \LayoutModel &$objLayout, \PageRegular $objPageRegular ) {

        if ( $objPage->excludeMautic || \Input::cookie('MAUTIC_DO_NOT_TRACK') ) {

            return null;
        }

        $strHost = \Config::get('mauticHost') ?: '';
        $objRoot = PageWizard::getRootPage( $objPage->id );

        if ( $objRoot !== null ) {

            if ( $objRoot->excludeMautic ) {

                return null;
            }

            if ( $objRoot->mauticHost ) {

                $strHost = $objRoot->mauticHost;
            }
        }

        $objLayout->script .= TrackingScript::trackingScript( $strHost );
    }
}