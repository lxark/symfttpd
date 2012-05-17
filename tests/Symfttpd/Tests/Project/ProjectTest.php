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

namespace Symfttpd\Tests\Project;

/**
 * ProjectTest class
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class ProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getOptions
     * @param $options
     * @param $values
     */
    public function testInitialize($options, $values)
    {
        $project = new \Symfttpd\Tests\Fixtures\TestProject(new \Symfttpd\OptionBag($options), new \Evenement\EventEmitter());
        $project->scan();
        $this->assertEquals($values['dirs'], $project->readableDirs);
        $this->assertEquals($values['files'], $project->readableFiles);
        $this->assertEquals($values['php'], $project->readablePhpFiles);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetPathException()
    {
        $project = $this->getMockForAbstractClass('\\Symfttpd\\Project\\BaseProject', array(new \Symfttpd\OptionBag(), new \Evenement\EventEmitter()));
        $project->setRootDir(__DIR__.'/foo/bar');
    }

    public function testGetRootDir()
    {
        $project = $this->getMockForAbstractClass('\\Symfttpd\\Project\\BaseProject', array(new \Symfttpd\OptionBag(), new \Evenement\EventEmitter()));
        $project->setRootDir(sys_get_temp_dir());
        $this->assertEquals(realpath(sys_get_temp_dir()), $project->getRootDir());
    }

    public function getOptions()
    {
        return array(
            array(
                array(),
                array(
                    'dirs' => array('uploads'),
                    'files' => array('authors.txt'),
                    'php' => array('class.php', 'index.php', 'phpinfo.php')
                )
            ),
            array(
                array('project_readable_restrict' => true),
                array(
                    'dirs' => array('uploads'),
                    'files' => array('authors.txt'),
                    'php' => array('index.php')
                )
            ),
            array(
                array(
                    'project_readable_restrict' => true,
                    'project_readable_phpfiles' => array('index.php', 'phpinfo.php'),
                ),
                array(
                    'dirs' => array('uploads'),
                    'files' => array('authors.txt'),
                    'php' => array('index.php', 'phpinfo.php'),
                )
            ),
            array(
                array(
                    'project_readable_phpfiles' => array('index.php', 'phpinfo.php'),
                ),
                array(
                    'dirs' => array('uploads'),
                    'files' => array('authors.txt'),
                    'php' => array('class.php', 'index.php', 'phpinfo.php'),
                )
            ),
        );
    }

    /**
     * @expectedException \Symfttpd\Project\Exception\ProjectException
     * @expectedExceptionMessage The name must be set.
     */
    public function testGetName()
    {
        $project = $this->getMockForAbstractClass('\\Symfttpd\\Project\\BaseProject', array(new \Symfttpd\OptionBag(), new \Evenement\EventEmitter()));
        $project->getName();
    }

    /**
     * @expectedException \Symfttpd\Project\Exception\ProjectException
     * @expectedExceptionMessage The version must be set.
     */
    public function testGetVersion()
    {
        $project = $this->getMockForAbstractClass('\\Symfttpd\\Project\\BaseProject', array(new \Symfttpd\OptionBag(), new \Evenement\EventEmitter()));
        $project->getVersion();
    }
}

