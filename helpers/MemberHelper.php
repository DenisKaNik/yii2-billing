<?php

namespace app\helpers;

class MemberHelper
{
    public static function formatterPhone($raw_phone): string
    {
        return
            preg_replace(
            '/^(\d{3})(\d{3})(\d{2})(\d{2})$/',
            '+7 ($1) $2-$3-$4',
            (string)$raw_phone
        );
    }
}
