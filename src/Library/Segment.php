<?php

namespace Alnv\MauticBundle\Library;

use Alnv\MauticBundle\Mautic\Api;


class Segment {


    public function getSegments() {

        if ( \Cache::has('mautic_segments') ) {

            return \Cache::get('mautic_segments');
        }

        $arrReturn = [];
        $objApi = new Api();
        $arrSegments = $objApi->getSegments();

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

        \Cache::set( 'mautic_segments', $arrReturn );

        return $arrReturn;
    }
}