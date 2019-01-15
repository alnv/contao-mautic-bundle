<?php

namespace Alnv\MauticBundle\DataContainer;


class MauticSettings {


    public function removeNewsletterPalette() {

        $objDatabase = \Database::getInstance();

        if ( !$objDatabase->tableExists( 'tl_newsletter_channel' ) ) {

            $GLOBALS['TL_DCA']['tl_mautic_settings']['palettes']['default'] = str_replace( '{newsletter_settings},mauticUseNewsletter', '', $GLOBALS['TL_DCA']['tl_mautic_settings']['palettes']['default'] );
        }
    }
}