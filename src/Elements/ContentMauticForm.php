<?php

namespace Alnv\MauticBundle\Elements;

use Alnv\MauticBundle\Library\Form;


class ContentMauticForm extends \ContentElement {


    protected $strTemplate = 'mod_mautic_form';


    public function generate() {

        if ( TL_MODE == 'BE' ) {

            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### '. $GLOBALS['TL_LANG']['CTE']['mautic_form'][0] .' ###';

            return $objTemplate->parse();
        }

        if ( !$this->mautic_form ) {

            return '';
        }

        return parent::generate();
    }


    public function compile() {

        $this->setFormScript();

        $objForm = new Form();

        $this->Template->form = $objForm->getFormTemplate( $this->mautic_form );
    }


    protected function setFormScript() {

        global $objPage;

        $objPage->mautic_use_form_script = '1';
    }
}