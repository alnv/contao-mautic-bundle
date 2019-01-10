<?php

namespace Alnv\MauticBundle\Library;


class Scripts {


    public static function trackingScript( $strHost ) {

        return '<script id="mt-track-script" defer>(function(w,d,t,u,n,a,m){w[\'MauticTrackingObject\']=n;w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)})(window,document,\'script\',\''. $strHost .'/mtc.js\',\'mt\');mt(\'send\', \'pageview\');</script>';
    }


    public static function focusItemScript( $strBody ) {

        return '<script id="mt-focus-item-script" defer>'. $strBody .'</script>';
    }
}