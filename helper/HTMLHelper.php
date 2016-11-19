<?php

/**
 * Created by PhpStorm.
 * User: bilguun
 * Date: 11/19/16
 * Time: 2:12 PM
 */
class HTMLHelper
{
    public function __construct()
    {
    }

    public function tableItem($string, $attributes){
        return "<td $attributes>".$string."</td>";
    }
    public function table($data, $col, $attributes){

    }
}