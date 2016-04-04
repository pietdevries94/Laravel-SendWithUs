<?php

/*
 * This file is part of Laravel SendWithUs.
 *
 * (c) Piet de Vries <piet@compenda.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Compenda\SendWithUs;

use sendwithus\API;
use InvalidArgumentException;

/**
 * This is the sendwithus factory class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SendWithUsFactory
{
    /**
     * Make a new sendwithus client.
     *
     * @param string[] $config
     *
     * @return \sendwithus\API
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('api_key', $config) || !array_key_exists('options', $config)) {
            throw new InvalidArgumentException('The sendwithus client requires authentication.');
        }

        return array_only($config, ['api_key', 'options']);
    }

    /**
     * Get the sendwithus client.
     *
     * @param string[] $auth
     *
     * @return \sendwithus\API
     */
    protected function getClient(array $auth)
    {
        return new API($auth['api_key'], $auth['options']);
    }
}
