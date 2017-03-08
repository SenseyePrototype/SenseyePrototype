<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Entity\Manager\UserManager;
use AppBundle\Entity\SocialProfile;
use AppBundle\Entity\User;
use AppBundle\Service\OAuth\UserResponseMapper\ResponseMapperInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AbstractResponseHandler
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
abstract class AbstractResponseHandler implements ResponseHandlerInterface
{
    /**
     * @var array
     */
    private $socialNameCodeMap = [
        'github' => SocialProfile::SOCIAL_CODE_GITHUB,
        'bitbucket' => SocialProfile::SOCIAL_CODE_BITBUCKET,
        'google' => SocialProfile::SOCIAL_CODE_GOOGLE,
    ];

    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var ResponseMapperInterface
     */
    protected $responseMapper;

    /**
     * AbstractResponseHandler constructor.
     *
     * @param UserManager             $userManager
     * @param ResponseMapperInterface $responseMapper
     * @param SessionInterface        $session
     */
    public function __construct(
        UserManager $userManager,
        SessionInterface $session,
        ResponseMapperInterface $responseMapper
    ) {
        $this->userManager = $userManager;
        $this->session = $session;
        $this->responseMapper = $responseMapper;
    }

    /**
     * @param UserResponseInterface $response
     *
     * @return UserInterface
     */
    public function processOAuthUserResponse(UserResponseInterface $response): UserInterface
    {
        $socialCode = $this->socialNameCodeMap[$response->getResourceOwner()->getName()];

        $social = $this->userManager->findBySocial(
            $socialCode,
            $response->getUsername()
        );

        $now = new \DateTime();

        if ($social === null) {
            $isUserWithSameEmail = $this->userManager->findUserByEmail($response->getEmail());

            /* @var $user User */
            if ($isUserWithSameEmail) {
                $user = $isUserWithSameEmail;
            } else {
                $user = new User();

                $user
                    ->setUsername($response->getNickname())
                    ->setEmail($response->getEmail())
                    ->setCreated($now)
                    ->setUpdated($now);
            }

            $social = new SocialProfile();
            $social
                ->setUser($user)
                ->setName($response->getNickname())
                ->setEmail($response->getEmail())
                ->setAccessToken($response->getAccessToken())
                ->setProfileId($response->getUsername())
                ->setSocialCode($socialCode)
                ->setCreated($now)
                ->setUpdated($now);

            $user->addSocialProfile($social);

            return $this->userManager->save($user);
        }

        $social
            ->setUpdated($now)
            ->setAccessToken($response->getAccessToken());

        return $social->getUser();
    }

    /**
     * @param UserResponseInterface $response
     *
     * @return SocialProfile|null
     */
    abstract protected function getUserByResourceOwnerId(UserResponseInterface $response);

    /**
     * @param UserResponseInterface $response
     * @param UserInterface         $user
     *
     * @return UserInterface
     */
    abstract protected function updateUserAccessToken(UserResponseInterface $response, UserInterface $user);

}
