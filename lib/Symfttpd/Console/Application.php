<?php
/**
 * This file is part of the Symfttpd Project
 *
 * (c) Laurent Bachelier <laurent@bachelier.name>
 * (c) Benjamin Grandfond <benjamin.grandfond@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfttpd\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfttpd\Symfttpd;
use Symfttpd\Configuration\SymfttpdConfiguration;

/**
 * Application class
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class Application extends BaseApplication
{
    /**
     * @var Symfttpd\Symfttpd
     */
    protected $symfttpd;

    /**
     * Constructor
     * Initialize a Symfttpd object.
     */
    public function __construct()
    {
        parent::__construct('Symfttpd', Symfttpd::VERSION);
    }

    /**
     * Return Symfttpd
     *
     * @return \Symfttpd\Symfttpd
     */
    public function getSymfttpd()
    {
        if (null == $this->symfttpd) {
            $this->symfttpd = new Symfttpd(new SymfttpdConfiguration());
        }

        return $this->symfttpd;
    }

    /**
     * @param \Symfttpd\Symfttpd $symfttpd
     */
    public function setSymfttpd(Symfttpd $symfttpd)
    {
        $this->symfttpd = $symfttpd;
    }
}
