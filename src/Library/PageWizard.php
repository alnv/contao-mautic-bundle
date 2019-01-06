<?php

namespace Alnv\MauticBundle\Library;


class PageWizard {


    public static function getRootPage( $strPageId ) {

        if ( !$strPageId ) {

            return null;
        }

        $objPage = \PageModel::findByPk( $strPageId );

        if ( $objPage !== null ) {

            if ( $objPage->pid ) {

                return self::getRootPage( $objPage->pid );
            }

            else {

                return $objPage;
            }
        }

        return null;
    }
}