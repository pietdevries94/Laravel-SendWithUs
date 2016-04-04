<?php

/*
 * This file is part of Laravel SendWithUs.
 *
 * (c) Piet de Vries <piet@compenda.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Compenda\SendWithUs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the sendwithus facade class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SendWithUs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sendwithus';
    }
}
