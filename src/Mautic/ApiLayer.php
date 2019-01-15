<?php

namespace Alnv\MauticBundle\Mautic;


abstract class ApiLayer {


    protected $objApi = null;


    public function __construct() {

        if ( !$this->objApi ) {

            $this->objApi = new Api();
        }
    }
}