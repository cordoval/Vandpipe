<?php

namespace Vandpipe\Generator;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
interface GeneratorInterface
{
    /**
     * Generates a value
     *
     * @return string
     */
    public function generate();
}
