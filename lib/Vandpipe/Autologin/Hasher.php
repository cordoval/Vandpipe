<?php

namespace Vandpipe\Autologin;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Hasher implements HasherInterface
{
    /**
     * @var string
     */
    protected $secret;

    /**
     * @param string $secret
     */
    public function __construct($secret)
    {
        $this->secret = (string) $secret;
    }

    /**
     * {@inheritdoc}
     */
    public function hash(array $parameters)
    {
        // Helps to make sure the parameters are in the correct order no matter what order
        // they are given to the method.
        asort($parameters);

        return md5(http_build_query($parameters) . '{' . $this->secret . '}');
    }
}
