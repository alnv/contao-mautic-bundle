<?php

namespace Alnv\MauticBundle\DataContainer;

use Alnv\MauticBundle\Library\Roles;


class FormField {


    public function getRoles() {

        $objRoles = new Roles();

        return $objRoles->getRoles();
    }
}