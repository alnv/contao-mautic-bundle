<?php

namespace Alnv\MauticBundle\DataContainer;

use Alnv\MauticBundle\Library\FocusItem;
use Alnv\MauticBundle\Library\Segment;
use Alnv\MauticBundle\Library\Role;


class OptionsCallback {


    public function getFocusItems() {

        $objFocusItem = new FocusItem();

        return $objFocusItem->getList();
    }


    public function getRoles() {

        $objRole = new Role();

        return $objRole->getRoles();
    }


    public function getSegments() {

        $objRole = new Segment();

        return $objRole->getSegments();
    }
}