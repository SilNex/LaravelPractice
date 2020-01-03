<?php

namespace App;

use Request;

function autoApiHtmlReturner($apiReturn, $htmlReturn)
{
    if (Request::wantsJson()) {
        return $apiReturn;
    } else {
        return $htmlReturn;
    }
}