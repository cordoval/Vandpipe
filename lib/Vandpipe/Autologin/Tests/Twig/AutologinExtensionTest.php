<?php

namespace Vandpipe\Autologin\Tests\Twig;

use Vandpipe\Autologin\Twig\AutologinExtension;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class AutologinExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->generator = $this->getMock('Vandpipe\Autologin\GeneratorInterface');
        $this->user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $this->router = $this->getMock('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $this->extension = new AutologinExtension($this->generator, $this->router);
    }

    public function testGetFunctions()
    {
        $this->assertContainsOnly('Twig_Function', $this->extension->getFunctions());
        $this->assertArrayHasKey('autologin_url', $this->extension->getFunctions());
    }

    public function testGenerateAutologinUrl()
    {
        $this->generator
            ->expects($this->once())
            ->method('generate')
            ->with($this->equalTo($this->user), $this->equalTo(86400))
            ->will($this->returnValue('autologin'))
        ;

        $this->router
            ->expects($this->once())
            ->method('generate')
            ->with($this->equalTo('some_route'), $this->equalTo(array('_al' => 'autologin')), $this->equalTo(true))
            ->will($this->returnValue('someurl'))
        ;

        $this->extension->generateAutologinUrl($this->user, 'some_route', array());
    }

    public function testGetFilters()
    {
        $this->assertContainsOnly('Twig_Filter', $this->extension->getFilters());

        $this->assertArrayHasKey('autologin', $this->extension->getFilters());
    }

    public function testGenerateAutologin()
    {
        $this->generator
            ->expects($this->once())
            ->method('generate')
            ->will($this->returnValue('generated-value'))
        ;

        $this->assertEquals('generated-value', $this->extension->generateAutologin($this->user));
    }

    public function testGetName()
    {
        $this->assertEquals('autologin', $this->extension->getName());
    }
}
