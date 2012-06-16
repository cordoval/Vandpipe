Vandpipe Autologin
===================

Dependencies
------------

* [Symfony\Component\HttpFoundation](http://github.com/symfony/HttpFoundation)
* [Symfony\Component\Security](http://github.com/symfony/Security)

Validating DependencyInjection configuration
--------------------------------------------

This is done throught ``xmllint`` with the following command line.

``` sh
$ xmllint --schema http://symfony.com/schema/dic/services/services-1.0.xsd lib/Vandpipe/Autologin/Resources/config/services.xml > /dev/null
```


Twig Extension
--------------

There is an extension for Twig that makes the ``autologin`` function available to templates.

``` php
<?php
$twig->addExtension(new AutologinExtension($generator))
```

``` jinja
{# Returns an absolute url with the autologin generated string appended #}
<a href="{{ autologin_url(app.user, 'vandpipe_user_edit') }}">Edit profile</a>

{# Returns the autologin generated string. #}
{{ user|autologin }}
```

Jmikola AutoLoginBundle
-----------------------

The `UserProvider` class is an implementation of `AutoLoginUserProvider` for [JmikolaAutoLoginBundle](http://github.com/jmikola/jmikolaautologinbundle).

``` php
<?php

use Vandpipe\Autologin\UserProvider;
use Vandpipe\Autologin\Generator;
use Symfony\Component\Security\Core\User\UserProviderInterface;

$provider = new UserProvider(UserProviderInterface $provider, Generator $generator);
```
