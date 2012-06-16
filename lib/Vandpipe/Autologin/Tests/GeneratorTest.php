<?php

namespace Vandpipe\Autologin\Tests;

use Vandpipe\Autologin\Generator;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->hasher = $this->getMock('Vandpipe\Autologin\HasherInterface');
        $this->user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $this->generator = new Generator($this->hasher);
    }

    public function testGenerate()
    {
        $this->hasher
            ->expects($this->once())
            ->method('hash')
            ->will($this->returnValue('rikke-likes-hash'))
        ;

        $this->user
            ->expects($this->once())
            ->method('getUsername')
            ->will($this->returnValue('rikkipige'))
        ;

        $query = $this->generator->generate($this->user);

        parse_str(base64_decode($query));

        $this->assertEquals('rikkipige', $username);
        $this->assertEquals('rikke-likes-hash', $hash);
        $this->assertEquals(time() + 86400, $expireAt);
    }
}
