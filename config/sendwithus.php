<?php

/*
 * This file is part of Laravel SendWithUs.
 *
 * (c) Piet de Vries <piet@compenda.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | SendWithUs Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'api_key'  => env('SENDWITHUS_KEY'),
            'options'  => [
                'DEBUG' => env('SENDWITHUS_DEBUG', false)
            ],
        ],
    ],

];
