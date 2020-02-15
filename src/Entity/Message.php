<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Class message
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 * @ORM\Table(name="Message")
 */
class Message
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $sender;

    /**
     * @ORM\Column(type="string")
     */
    private $subject;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * One message have Many Recipients.
     * @ORM\OneToMany(targetEntity="Recipient", mappedBy="id_messages", cascade={"persist", "remove"})
     */
    private $recipients;

    /**
     * One Message have Many Attachments.
     * @ORM\OneToMany(targetEntity="Attachment", mappedBy="message", cascade={"persist", "remove"})
     */
    private $attachments;


    /**
     * message constructor.
     * @param int $id
     * @param string $sender
     * @param string $subject
     * @param string $content
     */
    public function __construct(string $sender = null, string $subject = null, string $content = null)
    {
        $this->sender = $sender;
        $this->subject = $subject;
        $this->content = $content;
        $this->recipients = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }


    /*------------------------------------------------------------------------------------------------------------------*/

    /**
     * @return ArrayCollection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param ArrayCollection $attachments
     */
    public function setAttachments(ArrayCollection $attachments): void
    {
        $this->attachments = $attachments;
    }

    /**
     * @return ArrayCollection
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param $recipients
     * @return Message
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Message
     */
    public function setId(int $id): Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     * @return Message
     */
    public function setSender(string $sender): Message
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Message
     */
    public function setSubject(string $subject): Message
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): Message
    {
        $this->content = $content;
        return $this;
    }


}