<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Scripts;
use Alnv\MauticBundle\Library\FocusItem;
use Alnv\MauticBundle\Library\PageWizard;


class Page {


    public function onPageGeneration( \PageModel $objPage, \LayoutModel &$objLayout, \PageRegular $objPageRegular ) {

        $objRoot = PageWizard::getRootPage( $objPage->id );

        $this->addMauticFormScript( $objPage, $objRoot, $objLayout );
        $this->addTrackingScript( $objPage, $objRoot, $objLayout );
        $this->getFocusItem( $objPage, $objRoot, $objLayout );
    }


    protected function addTrackingScript( $objPage, $objRoot, &$objLayout ) {

        if ( $objPage->exclude_mautic || \Input::cookie('MAUTIC_DO_NOT_TRACK') ) {

            return null;
        }

        $arrParameter = [];
        $strHost = \Config::get('mauticHost') ?: '';

        if ( $objRoot !== null ) {

            if ( $objRoot->exclude_mautic ) {

                return null;
            }

            if ( $objRoot->mautic_host ) {

                $strHost = $objRoot->mautic_host;
            }
        }

        if ( FE_USER_LOGGED_IN ) {

            $objUser = \FrontendUser::getInstance();
            $arrParameter['email'] = $objUser->email;
            $arrParameter['lastname'] = $objUser->lastname;
            $arrParameter['firstname'] = $objUser->firstname;
            $arrParameter['company'] = $objUser->company ?: '';
        }

        $objLayout->script .= Scripts::trackingScript( $strHost, $arrParameter );
    }


    protected function getFocusItem( $objPage, $objRoot, &$objLayout ) {

        if ( $objPage->use_mautic && $objPage->mautic_focus_item ) {

            $this->addFocusItem( $objPage->mautic_focus_item, $objLayout );

            return null;
        }

        if ( $objRoot->use_mautic && $objRoot->mautic_focus_item ) {

            $this->addFocusItem( $objRoot->mautic_focus_item, $objLayout );

            return null;
        }


        if ( $objLayout->use_mautic && $objLayout->mautic_focus_item ) {

            $this->addFocusItem( $objLayout->mautic_focus_item, $objLayout );

            return null;
        }
    }


    protected function addFocusItem( $strId, &$objLayout ) {

        $objFocusItem = new FocusItem();
        $strScript = $objFocusItem->getById( $strId, true );

        if ( !$strScript ) {

            return null;
        }

        $objLayout->script .= Scripts::focusItemScript( $strScript );
    }


    protected function addMauticFormScript( $objPage, $objRoot, &$objLayout ) {

        if ( $objPage->mautic_use_form_script ) {

            $strHost = \Config::get('mauticHost') ?: '';

            if ( $objRoot !== null ) {

                if ( $objRoot->mautic_host ) {

                    $strHost = $objRoot->mautic_host;
                }
            }

            $objLayout->script .= Scripts::getFormScript( $strHost );
        }
    }
}