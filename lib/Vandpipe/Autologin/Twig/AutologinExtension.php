<?php

namespace Vandpipe\Autologin\Twig;

use Vandpipe\Autologin\GeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class AutologinExtension extends \Twig_Extension
{
    /**
     * @var GeneratorInterface
     */
    protected $generator;

    /**
     * @var UrlGeneratorInterface
     */
    protected $router;

    /**
     * @param GeneratorInterface $generator
     */
    public function __construct(GeneratorInterface $generator, UrlGeneratorInterface $router)
    {
        $this->generator = $generator;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'autologin' => new \Twig_Filter_Method($this, 'generateAutologin'),
        );
    }

    public function getFunctions()
    {
        return array(
            'autologin_url' => new \Twig_Function_Method($this, 'generateAutologinUrl'),
        );
    }

    /**
     * @param  UserInterface $user
     * @param  string        $route
     * @param  array         $parameters
     * @param  integer       $ttl
     * @return string
     */
    public function generateAutologinUrl(UserInterface $user, $route, array $parameters = array(), $ttl = 86400)
    {
        $parameters['_al'] = $this->generateAutologin($user, $ttl);

        return $this->router->generate($route, $parameters, true);
    }

    /**
     * @param  UserInterface $user
     * @param  integer       $ttl
     * @return string
     */
    public function generateAutologin(UserInterface $user, $ttl = 86400)
    {
        return $this->generator->generate($user, $ttl);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'autologin';
    }
}
