<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class User
 * @ORM\Entity()
 * @ORM\Table(name="User")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $avatar;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $city;

    /**
     * One recipient have Many Messages.
     * @ORM\OneToMany(targetEntity="Recipient", mappedBy="id_users", cascade={"persist", "remove"})
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="users")
     */
    private $groups;

    /**
     * @var ArrayCollection $recipients
     * @ORM\OneToMany(targetEntity="Friendship", mappedBy="id_sender")
     */
    private $recipients;

    /**
     * @var ArrayCollection $senders
     * @ORM\OneToMany(targetEntity="Friendship", mappedBy="id_recipient")
     */
    private $senders;

    /**
     * User constructor.
     * @param string $name
     * @param string $password
     * @param string $email
     * @param string $avatar
     */
    public function __construct($name = null, $password = null, $email = null, $avatar = null)
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->setAvatar($avatar);
        $this->messages = new ArrayCollection();
        $this->senders = new ArrayCollection();
        $this->recipients = new ArrayCollection();
    }

    /*-------------------------------------------------------------------------------------------------------------------------*/


    /**
     * @return ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param $messages
     * @return User
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        if (!is_null($avatar)) {
            $this->avatar = $avatar;
        } else {
            $this->avatar = "../../templates/avatars/unknown.jpg";
        }
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return User
     */
    public function setAge(int $age): User
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return User
     */
    public function setCountry(string $country): User
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return User
     */
    public function setCity(string $city): User
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups): void
    {
        $this->groups = $groups;
    }

    /**
     * @return ArrayCollection
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param ArrayCollection $recipients
     */
    public function setRecipients(ArrayCollection $recipients): void
    {
        $this->recipients = $recipients;
    }

    /**
     * @return ArrayCollection
     */
    public function getSenders()
    {
        return $this->senders;
    }

    /**
     * @param ArrayCollection $senders
     */
    public function setSenders(ArrayCollection $senders): void
    {
        $this->senders = $senders;
    }


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}