<?php
defined('BASEPATH') or exit('No direct script access allowed');

function numbers_percent($num_init=0, $num_total=0)
{
    $result = 0;
    if($num_init>0 && $num_total>0){
        $result = number_format(($num_init/$num_total) * 100);
    }
    return $result;
}