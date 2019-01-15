<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\ApiLayer;


class Segment extends ApiLayer{


    public function getSegments() {

        $arrReturn = [];
        $arrSegments = $this->objApi->getSegments();

        if ( !is_array( $arrSegments ) ) {

            return null;
        }

        if ( !isset( $arrSegments['lists'] ) || !is_array( $arrSegments['lists'] ) ) {

            return null;
        }

        foreach ( $arrSegments['lists'] as $arrSegment ) {

            if ( $arrSegment['isPublished'] ) {

                $arrReturn[ $arrSegment['id'] ] = $arrSegment['name'];
            }
        }

        return $arrReturn;
    }
}