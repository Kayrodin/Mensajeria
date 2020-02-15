<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Friendship
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="Friendship")
 */
class Friendship
{
    /**
     * @var integer $id
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recipients")
     */
    private $id_sender;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="senders")
     */
    private $id_recipient;

    /**
     * @var boolean $status
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * Friendship constructor.
     * @param $id_friend
     * @param bool $status
     */
    public function __construct($id_sender, $id_recipient, bool $status)
    {
        $this->id_sender = $id_sender;
        $this->id_recipient = $id_recipient;
        $this->status = $status;
    }

    /*---------------------------------------------------------------------------------------------------------------------*/
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdFriend()
    {
        return $this->id_friend;
    }

    /**
     * @param mixed $id_friend
     */
    public function setIdFriend($id_friend): void
    {
        $this->id_friend = $id_friend;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }


}