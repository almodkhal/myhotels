<?php
use Illuminate\Support\Facades\DB;
function d($arr) {
    echo "<pre>";print_r($arr);echo "</pre>";die;
}
function isGuest() {
    if(Auth::guest()) {
        return TRUE;
    }
    return FALSE;
}

function isAdmin() {
    if(!isGuest() && Auth::user()->role=='admin') {
        return TRUE;
    }
    return FALSE;
}

function isManager() {
    if(!isGuest() && Auth::user()->role=='manager') {
        return TRUE;
    }
    return FALSE;
}

function isUser() {
    if(!isGuest() && Auth::user()->role=='user') {
        return TRUE;
    }
    return FALSE;
}

function checkExist($val,$col) {
    if(DB::table('users')->where($col,$val)->exists()) {
        return TRUE;
    }
    return FALSE;
}

function create_slug($str) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $str);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text;
}

function getLabel($status) {
    $labelArr = array('pending' => 'secondary', 'accepted' => 'success', 'rejected' => 'warning', 'canceled' => 'danger', 'checkedin' => 'info', 'checkedout' => 'success');

    return $labelArr[$status];
}