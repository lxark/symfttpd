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

namespace Symfttpd\Server;

use Symfttpd\Configuration\SymfttpdConfiguration;
use Symfttpd\Configuration\Exception\ConfigurationException;
use Symfttpd\Project\ProjectInterface;
use Symfttpd\Renderer\TwigRenderer;
use Evenement\EventEmitter;
use Symfttpd\OptionBag;

/**
 * ServerInterface interface
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
interface ServerInterface
{
    /**
     * Server constructor.
     *
     * @param ProjectInterface $project
     * @param TwigRenderer $renderer
     * @param EventEmitter $emitter
     * @param OptionBag $options
     */
    public function __construct(ProjectInterface $project, TwigRenderer $renderer, EventEmitter $emitter, OptionBag $options);

    /**
     * Set up the options of the server.
     *
     * @abstract
     * @return mixed
     */
    public function setup();

    /**
     * Return the command that will run the server.
     * It is lighttpd for the Lighttpd server for example.
     *
     * @abstract
     * @return mixed
     */
    public function getCommand();

    /**
     * @abstract
     * @param $command
     * @return mixed
     */
    public function setCommand($command);

    /**
     * Read the configuration.
     *
     * @abstract
     * @param SymfttpdConfiguration $configuration
     * @return mixed
     */
    public function generate(SymfttpdConfiguration $configuration);

    /**
     * Write the configuration in the directory.
     *
     * @abstract
     * @return mixed
     * @throws Exception\ConfigurationException
     */
    public function write();

    /**
     * Run the server command to start it.
     *
     * @abstract
     * @return mixed
     */
    public function start();

    /**
     * Return the restart file path.
     *
     * @abstract
     * @return mixed
     */
    public function getRestartFile();

    /**
     * Delete the restart file if exists.
     *
     * @abstract
     */
    public function removeRestartFile();

    /**
     * Return the pidfile which contains
     * the pid of the process of the server.
     *
     * @abstract
     * @return mixed
     */
    public function getPidfile();
}
