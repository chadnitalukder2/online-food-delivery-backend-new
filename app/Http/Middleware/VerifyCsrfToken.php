<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // 'register',
        '*', // This will exclude all routes under /api from CSRF protection
        '/pay-via-ajax', '/success','/cancel','/fail','/ipn'
    ];
}