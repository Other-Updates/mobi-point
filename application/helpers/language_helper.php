<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('get_words')) {

    function get_words($code, $key)
    {
        $ci = &get_instance();

        // $language = $ci->user_auth->get_language();
        $language =  "English";

        $file = $ci->config->item("base_url") . 'attachments/language/language.json';

        $json = json_decode(file_get_contents($file));

        if (empty($language))
            $language = "English";
        $tmp = array();
        foreach ($json as $k => $v)
            $tmp[$k] = $v->Code;
        $tmp = array_unique($tmp);

        foreach ($json as $k => $v) {
            if (!array_key_exists($k, $tmp))
                unset($json[$k]);
        }

        $result = array();
        foreach ($json as $obj) {
            if (in_array($obj->Location, $key)) {
                $result[$obj->Code] = $obj->$language;
            }
        }

        foreach ($json as $obj) {
            if (in_array($obj->Code, $code)) {
                $result[$obj->Code] = $obj->$language;
            }
        }

        return $result;
    }
}
