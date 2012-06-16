<?php

namespace Vandpipe\Autologin;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
interface HasherInterface
{
    /**
     * Must return a hashed value of $value. Could be `md5($value)` or something more
     * secure using a shared secret.
     *
     * @param  arrat  $parameters
     * @return string
     */
    public function hash(array $parameters);
}
