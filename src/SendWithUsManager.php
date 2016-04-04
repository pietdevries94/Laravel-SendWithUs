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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class SendWithUsManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Compenda\SendWithUs\SendWithUsFactory
     */
    protected $factory;

    /**
     * Create a new dropbox manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Compenda\SendWithUs\SendWithUsFactory  $factory
     *
     * @return void
     */
    public function __construct(Repository $config, SendWithUsFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \SendWithUs\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'sendwithus';
    }

    /**
     * Get the factory instance.
     *
     * @return \Compenda\SendWithUs\SendWithUsFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
