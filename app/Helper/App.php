<?php

function authUserFolder(): string
{
    $folder = '';
    if (Auth::check()) {
        $roles = Auth::user()->getRoleNames()->toArray();
        if (in_array('customer', $roles, true)) {
            $folder = 'customer';
        } elseif (in_array('service-provider', $roles, true)) {
            $folder = 'service-provider';
        } elseif (in_array('super-admin', $roles, true)) {
            $folder = 'super-admin';
        }else {
            $folder = 'admin';
        }
    }
    return $folder;
}
