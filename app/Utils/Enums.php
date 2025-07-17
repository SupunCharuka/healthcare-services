<?php

namespace App\Utils;

class Enums {

    public const SourceTypes = array(
        'UNKNOWN' => 0,
        'ANDROID_PHONE' => 1,
        'WEB_PHONE' => 2,
    );

    public const UserTypes = array();

    public const businessProfile = array(
        'PENDING' => 0,
        'APPROVED' => 1,
        'REJECTED' => 2,
    );

    public const inquiryStatus = array(
        'PENDING' => 0,
        'ASSIGN' => 1,
        'UNASSIGN' => 2,
    );

    public const invoicePaid = array(
        'PENDING' => 0,
        'APPROVED' => 1,
    );

    public const memberRegister = array(
        'PENDING' => 0,
        'APPROVED' => 1,
        'REJECTED' => 2,
    );

    public const order = array(
        'PENDING' => 0,
        'APPROVED' => 1,
        'REJECTED' => 2,
    );


}
