Vandpipe Form
==============

Dependencies
------------

* [Symfony\Component\Form](http://github.com/symfony/Form)
* [Symfony\Component\Security](http://github.com/symfony/Security)

EncoderTransformer - Auto encoding values with Security Component
-----------------------------------------------------------------

`EncoderTransformer` will automatically encode the value that is being reverse transformer with the correct
`PasswordEncoderInterface` through `EncoderFactoryInterface`.

``` php
<?php
$builder->get('password')->addModelTransformer(new EncoderTransformer($encoderFactory, $user))
```
