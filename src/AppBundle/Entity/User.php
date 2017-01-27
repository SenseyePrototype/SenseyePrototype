<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $facebookId;

    /**
     * @var string
     */
    private $facebookAccessToken;

    /**
     * @var string
     */
    private $googleId;

    /**
     * @var string
     */
    private $googleAccessToken;

    /**
     * @var string
     */
    private $linkedinId;

    /**
     * @var string
     */
    private $linkedinAccessToken;

    /**
     * @var string
     */
    private $bitbucketId;

    /**
     * @var string
     */
    private $bitbucketAccessToken;

    /**
     * @var string
     */
    private $githubId;

    /**
     * @var string
     */
    private $githubAccessToken;

    /**
     * @TODO store array of roles instead of static array
     *
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
       return $this->username;
    }

    public function eraseCredentials()
    {

    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set googleAccessToken
     *
     * @param string $googleAccessToken
     *
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }

    /**
     * Get googleAccessToken
     *
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->googleAccessToken;
    }

    /**
     * Set linkedinId
     *
     * @param string $linkedinId
     *
     * @return User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;

        return $this;
    }

    /**
     * Get linkedinId
     *
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Set linkedinAccessToken
     *
     * @param string $linkedinAccessToken
     *
     * @return User
     */
    public function setLinkedinAccessToken($linkedinAccessToken)
    {
        $this->linkedinAccessToken = $linkedinAccessToken;

        return $this;
    }

    /**
     * Get linkedinAccessToken
     *
     * @return string
     */
    public function getLinkedinAccessToken()
    {
        return $this->linkedinAccessToken;
    }

    /**
     * Set bitbucketId
     *
     * @param string $bitbucketId
     *
     * @return User
     */
    public function setBitbucketId($bitbucketId)
    {
        $this->bitbucketId = $bitbucketId;

        return $this;
    }

    /**
     * Get bitbucketId
     *
     * @return string
     */
    public function getBitbucketId()
    {
        return $this->bitbucketId;
    }

    /**
     * Set bitbucketAccessToken
     *
     * @param string $bitbucketAccessToken
     *
     * @return User
     */
    public function setBitbucketAccessToken($bitbucketAccessToken)
    {
        $this->bitbucketAccessToken = $bitbucketAccessToken;

        return $this;
    }

    /**
     * Get bitbucketAccessToken
     *
     * @return string
     */
    public function getBitbucketAccessToken()
    {
        return $this->bitbucketAccessToken;
    }

    /**
     * Set githubId
     *
     * @param string $githubId
     *
     * @return User
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * Get githubId
     *
     * @return string
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * Set githubAccessToken
     *
     * @param string $githubAccessToken
     *
     * @return User
     */
    public function setGithubAccessToken($githubAccessToken)
    {
        $this->githubAccessToken = $githubAccessToken;

        return $this;
    }

    /**
     * Get githubAccessToken
     *
     * @return string
     */
    public function getGithubAccessToken()
    {
        return $this->githubAccessToken;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $developerProfiles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->developerProfiles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add developerProfile
     *
     * @param \AppBundle\Entity\DeveloperProfile $developerProfile
     *
     * @return User
     */
    public function addDeveloperProfile(\AppBundle\Entity\DeveloperProfile $developerProfile)
    {
        $this->developerProfiles[] = $developerProfile;

        return $this;
    }

    /**
     * Remove developerProfile
     *
     * @param \AppBundle\Entity\DeveloperProfile $developerProfile
     */
    public function removeDeveloperProfile(\AppBundle\Entity\DeveloperProfile $developerProfile)
    {
        $this->developerProfiles->removeElement($developerProfile);
    }

    /**
     * Get developerProfiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeveloperProfiles()
    {
        return $this->developerProfiles;
    }
}
