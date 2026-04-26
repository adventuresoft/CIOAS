<?php

use Illuminate\Support\Facades\Auth;

if(! function_exists('basic_settings_permissions')){
    function basic_settings_permissions(){
        if (Auth::user()->role_id == 1  || Auth::user()->role_id == 4 ) {
            return true;
        } else {
            return false;
        }
    }
}

if(! function_exists('institute_permissions')){
    function institute_permissions(){
        if (Auth::user()->role_id == 1  || Auth::user()->role_id == 4 ) {
            return true;
        } else {
            return false;
        }
    }
}


if(! function_exists('create_permission')){
    function create_permission(){
        if (Auth::user()->role_id == 6 ) {
            return true;
        } else {
            return false;
        }
    }
}


if(! function_exists('edit_permission')){
    function edit_permission(){
        if (Auth::user()->role_id == 6  ) {
            return true;
        } else {
            return false;
        }
    }
}


if(! function_exists('view_permission')){
    function view_permission(){
        if (Auth::user()->role_id == 1  || Auth::user()->role_id == 4 ||  Auth::user()->role_id == 6 ) {
            return true;
        } else {
            return false;
        }
    }
}


if(! function_exists('delete_permission')){
    function delete_permission(){
        if (Auth::user()->role_id == 6 ) {
            return true;
        } else {
            return false;
        }
    }
}





