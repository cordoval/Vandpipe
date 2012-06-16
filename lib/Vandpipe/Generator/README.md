Vandpipe Generator
===================

Contains different Name generators that can be used for password generation or other
such things.

Heroku style
------------

[Heroku](http://heroku.com) Generate names for its servers like `red-flower-38`. The same can be done using
`HerokuGenerator` which will generate a name in the following format.

    Adjective-Noun-(Number from range 1-100)


``` php
<?php

use Vandpipe\Generator\HerokuGenerator;

$generator = new HerokuGenerator();

for ($i = 0; $i < 100; $i++) {
    print_r($generator->generate())
}
```
