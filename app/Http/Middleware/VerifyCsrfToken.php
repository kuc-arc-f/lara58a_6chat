<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/apisystem/delete_db_day',
        'api/apichats/get_send_members',
        'api/apichats/update_post_client',
//        'api/apitasks/get_tasks',
//        'api/cross_task/create_task',
    ];
    
}
