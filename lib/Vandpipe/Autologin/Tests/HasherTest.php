<?php

namespace Vandpipe\Autologin\Tests;

use Vandpipe\Autologin\Hasher;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class HasherTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->hasher = new Hasher('secret');
    }

    public function testHash()
    {
        $this->assertEquals(md5('0=value{secret}'), $this->hasher->hash(array('value')));
    }

    public function testHashParameterOrdering()
    {
        $hash = $this->hasher->hash(array(1 => '1', 2 => '2'));

        $this->assertEquals($hash, $this->hasher->hash(array(2 => '2', 1 => '1')));
    }
}
