<?php

namespace App\Http\Controllers;

use App\Http\Services\Logging;

class LoggingController
{
    public function all(Logging $logging) {
        return $logging->getAll();
    }
}
