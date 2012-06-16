<?php

namespace Vandpipe\Form\Tests\DataTransformer;

use Vandpipe\Form\DataTransformer\EncoderTransformer;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class EncoderTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = $this->getMock('Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface');
        $this->user = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');

        $this->transformer = new EncoderTransformer($this->factory, $this->user);
    }

    public function testReverseTransformWithEmptyValue()
    {
        $this->assertEquals('', $this->transformer->reverseTransform(''));
        $this->assertInternalType('null', $this->transformer->reverseTransform(null));
    }

    public function testReverseTransform()
    {
        $encoder = new PlaintextPasswordEncoder;

        $this->user
            ->expects($this->once())
            ->method('getSalt')
            ->will($this->returnValue('salt'))
        ;

        $this->factory
            ->expects($this->once())
            ->method('getEncoder')
            ->will($this->returnValue($encoder))
        ;

        $this->assertEquals('password{salt}', $this->transformer->reverseTransform('password'));
    }

    public function testTransform()
    {
        $this->assertEquals('nothing', $this->transformer->transform('nothing'));
    }
}
