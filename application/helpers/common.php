<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('style')) {

    function style($href, array $options = [])
    {
        $options = array_map(function ($option, $value) {
            return $options.'="'.$value.'"';
        }, $options);

        $options = implode(' ', $options);

        return '<link href="'.$href.'" '.$options.'/>'."\n\r";
    }
}
