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

namespace Symfttpd\Tests\Command;

use Symfttpd\Command\MksymlinksCommand;
use Symfttpd\Filesystem\Filesystem;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Tester\ApplicationTester;

/**
 * MksymlinksCommandTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 24/10/11
 */
class MksymlinksCommandTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->fixtures = sys_get_temp_dir();
        $this->filesystem = new Filesystem();

        $this->command = new MksymlinksCommand();

        $application = new \Symfttpd\Console\Application();
        $application->setAutoExit(false);
        $application->setSymfttpd($this->getSymfttpd());
        $application->add($this->command);

        $this->tester  = new ApplicationTester($application);
    }

    public function testExecute()
    {
        $this->tester->run(array('command' => $this->command->getName(),'type' => 'symfony', '--ver' => '1.4', '-p' => $this->fixtures.'/symfony-1.4'), array('interactive' => false));
    }

    public function testExecuteException()
    {
        $this->tester->run(array('command' => $this->command->getName()), array('interactive' => false));
        $this->assertRegExp('~RuntimeException~', $this->tester->getDisplay());
        $this->assertRegExp('~Not enough~', $this->tester->getDisplay());
    }

    public function getSymfttpd()
    {
        return new \Symfttpd\Symfttpd($this->getConfiguration());
    }

    public function getConfiguration()
    {
        $config = $this->getMock('\Symfttpd\Configuration\SymfttpdConfiguration');
        $config->expects($this->any())
            ->method('all')
            ->will($this->returnValue(array(
            'path'            =>  dirname(__FILE__),
            'genconf'         =>  'config/lighttpd.php',
            'data_symlink'    =>  false,
            'lib_symlink'     => 'lib/vendor/symfony',
            'symfony_symlink' =>  false,
            'web_symlink'     =>  'web/sf',
            'do_plugins'      =>  true,
            'relative'        =>  true,
            'want'            =>  '1.4',
            'sf_path'         =>  array(
                '1.0'=>getenv('HOME').'/Dev/symfony/1.0',
                '1.1'=>getenv('HOME').'/Dev/symfony/1.1',
                '1.2'=>getenv('HOME').'/Dev/symfony/1.2',
                '1.3'=>getenv('HOME').'/Dev/symfony/1.3',
                '1.4'=>getenv('HOME').'/Dev/symfony/1.4',
            ),
            'custom_path'     =>  array('/usr/sbin'),
            'lighttpd_cmd'    =>  null,
            'php_cmd'         =>  realpath(PHP_BINDIR.'/php'),
            'php_cgi_cmd'     =>  realpath(PHP_BINDIR.'/php-cgi'),
            'genconf_cmd'     =>  null,
            'config_template' =>  dirname(__FILE__).'/data/lighttpd.conf.php'
        )));

        return $config;
    }
}
