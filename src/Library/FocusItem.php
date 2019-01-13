<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class FocusItem {


    public function getList() {

        $arrReturn = [];
        $objApi = new Api();
        $arrFocusItems = $objApi->getFocusItemsList();

        if ( !is_array( $arrFocusItems ) ) {

            return $arrReturn;
        }

        if ( !isset( $arrFocusItems['focus'] ) ) {

            return $arrReturn;
        }

        foreach ( $arrFocusItems['focus'] as $arrFocusItem ) {

            $arrReturn[ $arrFocusItem['id'] ] = $arrFocusItem['name'];
        }

        return $arrReturn;
    }


    public function getById( $strId, $blnScript = true ) {

        $objApi = new Api();
        $varReturn = $blnScript ? '' : [];
        $arrFocusItem = $objApi->getFocusItem( $strId );

        if ( !is_array( $arrFocusItem ) ) {

            return $varReturn;
        }

        if ( !isset( $arrFocusItem['focus'] ) ) {

            return $varReturn;
        }

        if ( $blnScript ) {

            $varReturn = $arrFocusItem['focus']['cache'];
        }

        else {

            $varReturn = $arrFocusItem['focus'];
        }

        return $varReturn;
    }
}