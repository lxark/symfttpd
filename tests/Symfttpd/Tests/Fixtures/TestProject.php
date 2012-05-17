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

namespace Symfttpd\Tests\Fixtures;

/**
 * TestProject class
 * This class allow us to test the abstract BaseProject class.
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class TestProject extends \Symfttpd\Project\BaseProject
{
    protected $name = 'test',
              $version = "1.0";

    protected $filesystem;

    public function __construct(\Symfttpd\OptionBag $options, \Evenement\EventEmitter $emitter, $path = null)
    {
        if (null == $path) {
            $path = sys_get_temp_dir().'/symfttpd-project-test';
        }

        $this->filesystem = new \Symfttpd\Filesystem\Filesystem();

        parent::__construct($options, new \Evenement\EventEmitter(), $path);

        $this->buildProject();
    }


    /**
     * Return the cache directory of the project.
     *
     * @return mixed
     */
    public function getCacheDir()
    {
        return $this->getRootDir().'/cache';
    }

    /**
     * Return the log directory of the project.
     *
     * @return mixed
     */
    public function getLogDir()
    {
        return $this->getRootDir().'/log';
    }

    /**
     * Return the web directory of the project.
     *
     * @return mixed
     */
    public function getWebDir()
    {
        return $this->getRootDir().'/web';
    }

    /**
     * Return the index file.
     *
     * @return mixed
     */
    public function getIndexFile()
    {
        return 'index.php';
    }

    /**
     * Set the directory where lives the project.
     *
     * @param $rootDir
     * @return mixed
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * Create the structure of the test project.
     */
    public function buildProject()
    {
        $this->filesystem->mkdir(array(
            $this->getRootDir(),
            $this->getCacheDir(),
            $this->getLogDir(),
            $this->getWebDir(),
            $this->getWebDir().'/uploads',
        ));

        $this->filesystem->touch(array(
            $this->getIndexFile(),
            $this->getWebDir().'/class.php',
            $this->getWebDir().'/phpinfo.php',
            $this->getWebDir().'/authors.txt',
            $this->getWebDir().'/uploads/picture.png',
        ));
    }

    /**
     * Remove the structure of the test project.
     */
    public function removeProject()
    {
        $this->filesystem->remove(array(
            $this->getIndexFile(),
            $this->getWebDir().'/class.php',
            $this->getWebDir().'/phpinfo.php',
            $this->getWebDir().'/authors.txt',
            $this->getWebDir().'/uploads/picture.png',
            $this->getRootDir(),
            $this->getCacheDir(),
            $this->getLogDir(),
            $this->getWebDir(),
        ));
    }

    public function __destruct()
    {
        $this->removeProject();
    }
}
