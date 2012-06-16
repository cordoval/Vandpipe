Vandpipe Security
==================

Dependencies
------------

* [Symfony\Component\Security](http://github.com/symfony/security>)

Validation DependencyInjection configuration
--------------------------------------------

``` sh
$ xmllint --schema http://symfony.com/schema/dic/services/services-1.0.xsd Resources/config/services.xml > /dev/null
```

Only allowing anonymous/not authenticated users access
------------------------------------------------------

``` php
<?php
$accessDecisionManager = new AccessDecisionManager(array(
    new AnonymousVoter(),
));
```

``` yaml
# security.yml
security:
    access_control:
        - { path: /login, roles: [IS_ANONYMOUS] }
```

Bcrypt encoding
---------------

``` php
<?php
$encoder = new BcryptPasswordEncoder($cost = 5);

// Encode password. The second argument is the $salt which is ignored but
// part of the PasswordEncoderInterface definition
$encoder->encodePassword('password', null);
```


### Symfony2 SecurityBundle Integration

Assuming that `Resources/config/services.xml` have been loaded.

``` yaml
# security.yml
security:
    encoders:
        Vandpipe\VandpipeBundle\Model\User: { id: vandpipe.security.encoder.bcrypt }
```
