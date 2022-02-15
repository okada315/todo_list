<?php

class Validation
{
    public static function isDate($date)
    {
        return strtotime($date) == false ? false : true;
    }

    public static function isValidItemName($itemName)
    {
        if (strlen($itemName) > 100) {
            return false;
        }
        return true;
    }

    public static function isValidUserId($user_id)
    {
        if (!is_numeric($user_id)) {
            return false;
        }

        if ($user_id <= 0) {
            return false;
        }

    }
}