<?php

namespace Vandpipe\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class AnonymousVoter implements \Symfony\Component\Security\Core\Authorization\Voter\VoterInterface
{
    /**
     * The attribute name used for configs. `role: [IS_ANONYMOUS]`
     */
    const IS_ANONYMOUS = 'IS_ANONYMOUS';

    /**
     * @var AuthenticationTrustResolverInterface
     */
    protected $resolver;

    /**
     * @param AuthenticationTrustResolverInterface $resolver
     */
    public function __construct(AuthenticationTrustResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsAttribute($attribute)
    {
        return static::IS_ANONYMOUS == $attribute;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        foreach ($attributes as $attribute) {
            if (false == $this->supportsAttribute($attribute)) {
                continue;
            }

            return $this->resolver->isAnonymous() ? VoterInterface::ACCESS_GRANTED : VoterInterface::ACCESS_DENIED;
        }

        // None of the attributes is supported so we will abstain from voting.
        return VoterInterface::ACCESS_ABSTAIN;
    }
}
