<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('pre')) {

    function pre($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        die;
    }
}

if (! function_exists('format_value')) {

    function format_value($value)
    {
        return htmlspecialchars($value);
    }
}

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
