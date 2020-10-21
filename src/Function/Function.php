<?php

function removeUnnecessarySpaces($string)
{
    $string = preg_replace('/\s+/', ' ', $string);
    $string = trim($string);
    return $string;
}

function _s_has_special_chars($string)
{
    if (!preg_match('/[^a-zA-Z\d_@\.-]/', $string)) {
        return true;
    }
    return false;
}

function checkIfLengthOfStringIsBetweenNumbers($string, $min, $max)
{
    $string = preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY);

    if (count($string) > $min && count($string) < $max) {
        return true;
    } else {
        return false;
    }
}

function validateEmail($email)
{
    $result = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($email == $result && strlen($email) > 0) {
        if (ctype_alpha($email[0])) {
            if (_s_has_special_chars($email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {

        return false;
    }
}

function randomString($z)
{
    return substr(md5(date("d.m.Y.H.i.s") . rand(1, 1000000)), 0, $z);
}

function removeCharsAfterMonkey($email)
{
    $email = preg_split("//u", $email, -1, PREG_SPLIT_NO_EMPTY);

    $userName = "";

    for ($i = 0; $i < count($email); $i++) {
        if ($email[$i] == "@") {
            break;
        } else {
            $userName .= $email[$i];
        }
    }

    return $userName;
}

function compareValue($a, $b, $return)
{
    if ($a == $b) {
        echo  $return;
    }
}
