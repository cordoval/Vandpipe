<?php

namespace Vandpipe\Autologin\Tests;

use Vandpipe\Autologin\UserProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class UserProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->userProvider = $this->getMock('Symfony\Component\Security\Core\User\UserProviderInterface');
        $this->hasher = $this->getMock('Vandpipe\Autologin\HasherInterface');
        $this->provider = new UserProvider($this->userProvider, $this->hasher);
    }


    public function testThrowsExceptionWithInvalidHash()
    {
        $this->setExpectedException('Jmikola\AutoLoginBundle\Security\AutoLoginTokenNotFoundException', '"$key" contains invalid information.');

        $this->hasher
            ->expects($this->once())
            ->method('hash')
            ->will($this->returnValue('evenmoreinvalid'))
        ;

        $this->provider->loadUserByAutoLoginToken(base64_encode('username=henrik&expireAt=232322323&hash=invalid'));
    }

    public function testCallUserProviderWhenHashIsValid()
    {

        $this->hasher
            ->expects($this->once())
            ->method('hash')
            ->will($this->returnValue('valid'))
        ;

        $this->userProvider
            ->expects($this->once())
            ->method('loadUserByUsername')
            ->with($this->equalTo('henrik'))
        ;

        $this->provider->loadUserByAutoLoginToken(base64_encode('username=henrik&expireAt=232322323&hash=valid'));
    }
}
