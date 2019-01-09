<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\PageWizard;
use Alnv\MauticBundle\Library\TrackingScript;


class Page {


    public function onPageGeneration( \PageModel $objPage, \LayoutModel &$objLayout, \PageRegular $objPageRegular ) {

        if ( $objPage->exclude_mautic || \Input::cookie('MAUTIC_DO_NOT_TRACK') ) {

            return null;
        }

        $strHost = \Config::get('mauticHost') ?: '';
        $objRoot = PageWizard::getRootPage( $objPage->id );

        if ( $objRoot !== null ) {

            if ( $objRoot->exclude_mautic ) {

                return null;
            }

            if ( $objRoot->mautic_host ) {

                $strHost = $objRoot->mautic_host;
            }
        }

        $objLayout->script .= TrackingScript::trackingScript( $strHost );
    }
}