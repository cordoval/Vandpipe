<?php

namespace Vandpipe\Autologin;

use Vandpipe\Autologin\HasherInterface;
use Jmikola\AutoLoginBundle\Security\AutoLoginTokenNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class UserProvider implements \Jmikola\AutoLoginBundle\Security\AutologinUserProviderInterface
{
    /**
     * @var UserProviderInterface
     */
    protected $provider;


    /**
     * @var HasherInterface
     */
    protected $hasher;

    /**
     * @param UserProviderInterface $provider
     */
    public function __construct(UserProviderInterface $provider, HasherInterface $hasher)
    {
        $this->provider = $provider;
        $this->hasher = $hasher;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByAutoLoginToken($key)
    {
        $hash = null;

        // Parse the query string
        parse_str(base64_decode($key));

        if ($hash == $this->hasher->hash(compact('username', 'expireAt'))) {
            return $this->provider->loadUserByUsername($username);
        }

        throw new AutoLoginTokenNotFoundException('"$key" contains invalid information.');
    }
}
