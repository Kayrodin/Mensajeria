<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class recipient
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name = "Recipient")
 */
class Recipient
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="messages")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $id_users;

    /**
     * @ORM\ManyToOne(targetEntity="Message", inversedBy="recipients")
     * @ORM\JoinColumn(name="id_message", referencedColumnName="id")
     */
    private $id_messages;

    /**
     * @ORM\Column(type="boolean")
     */
    private $readed;

    /**
     * recipient constructor.
     * @param int $id
     * @param int $id_users
     * @param int $id_messages
     * @param bool $read
     */
    public function __construct(bool $read = false)
    {
        $this->readed = $read;
    }

    /*----------------------------------------------------------------------------------------------------------------------*/

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return recipient
     */
    public function setId(int $id): recipient
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsers(): int
    {
        return $this->id_users;
    }

    /**
     * @param int $id_users
     * @return recipient
     */
    public function setIdUsers(User $id_users): recipient
    {
        $this->id_users = $id_users;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdMessages(): int
    {
        return $this->id_messages;
    }

    /**
     * @param int $id_messages
     * @return recipient
     */
    public function setIdMessages(Message $id_messages): recipient
    {
        $this->id_messages = $id_messages;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->read;
    }

    /**
     * @param bool $read
     * @return recipient
     */
    public function setRead(bool $read): recipient
    {
        $this->read = $read;
        return $this;
    }

}