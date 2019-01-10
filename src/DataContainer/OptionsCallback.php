<?php

namespace Alnv\MauticBundle\DataContainer;

use Alnv\MauticBundle\Library\FocusItem;
use Alnv\MauticBundle\Library\Roles;


class OptionsCallback {


    public function getFocusItems() {

        $objFocus = new FocusItem();

        return $objFocus->getList();
    }


    public function getRoles() {

        $objRoles = new Roles();

        return $objRoles->getRoles();
    }
}