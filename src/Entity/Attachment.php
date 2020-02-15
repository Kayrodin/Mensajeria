<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Attachment
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="Attachment")
 */
class Attachment
{
    /**
     * @var integer $id
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * Many Attachments have one Message. This is the owning side.
     * @var integer $message
     * @ORM\ManyToOne(targetEntity="Message", inversedBy="attachments")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    private $message;

    /**
     * @var string $rute
     * @ORM\Column(type="string")
     */
    private $rute;

    /**
     * Attachment constructor.
     * @param int $id_message
     * @param string $rute
     */
    public function __construct(string $rute)
    {
        $this->rute = $rute;
    }


    /*------------------------------------------------------------------------------------------------------------------*/

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
     * @return string
     */
    public function getRute()
    {
        return $this->rute;
    }

    /**
     * @param int $rute
     */
    public function setRute(int $rute): void
    {
        $this->rute = $rute;
    }

    /**
     * @return int
     */
    public function getMessage(): int
    {
        return $this->message;
    }

    /**
     * @param int $message
     */
    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }


}