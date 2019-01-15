<?php

namespace Alnv\MauticBundle\Library;


class Scripts {


    public static function trackingScript( $strHost, $arrParameter = [] ) {

        return '<script id="mt-track-script" defer>(function(w,d,t,u,n,a,m){w[\'MauticTrackingObject\']=n;w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)})(window,document,\'script\',\''. $strHost .'/mtc.js\',\'mt\');mt(\'send\', \'pageview\', '. ( !empty( $arrParameter ) ? json_encode( $arrParameter) : '' ) .');</script>';
    }


    public static function focusItemScript( $strBody ) {

        return '<script id="mt-focus-item-script" defer>'. $strBody .'</script>';
    }


    public static function getFormScript( $strHost ) {

        $strScript = $strHost . '/media/js/mautic-form.js';
        
        return '<script id="mt-form-script" defer>if(typeof MauticSDKLoaded == \'undefined\'){var MauticSDKLoaded=true;var head=document.getElementsByTagName(\'head\')[0];var script=document.createElement(\'script\');script.type=\'text/javascript\';script.src=\''.$strScript.'\';script.onload=function(){MauticSDK.onLoad();};head.appendChild(script);var MauticDomain=\''.$strHost.'\';var MauticLang={\'submittingMessage\': "'.$GLOBALS['TL_LANG']['MSC']['mautic_form_loading'].'"}}</script>';
    }
}