<?php

namespace App\Http\Services;

use App\Models\LoggingErrors;

class Logging
{
    public function validationLog(array $data) {
        $this->log('validation', $data);
    }

    public function authLog(array $data) {
        $this->log('auth', $data);
    }

    public function log(string $type, array $data) {
        LoggingErrors::create([
            'type' => $type,
            'client_ip' => request()->ip(),
            'data' => json_encode($data)
        ]);
    }

    public function getAll() {
        return LoggingErrors::all();
    }
}
