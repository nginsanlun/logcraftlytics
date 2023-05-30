<?php
namespace App\Constants;

class LogConstant
{
    const METHOD = [
        "GET",
        "POST",
        "PUT",
        "DELETE",
        "PATCH"
    ];

    const LEVEL = [
        "INFO",
        "DEBUG",
        "ERROR",
        "WARNING",
        "NOTICE"
    ];

    const STATUS = [200, 400, 403, 404, 405, 406, 407, 408, 411, 412, 500];
}        
    