<?php
function dd($var){
    echo '<div style="width: 80%;margin: 0 auto;background: #ddd8d8;padding: 44px;"><pre>';print_r($var);echo '</pre></div>';die;
}
function dv($var){
    echo '<pre>';var_dump($var);echo '</pre>';die;
}