<?php


namespace App\Repository;


use App\Entity\Attachment;
use App\Entity\Message;
use App\Entity\Recipient;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;

class MessageRepository extends EntityRepository
{
    public function perisistMessage(Message $message, $sender, $files, $recip, $id_message)
    {
        $message->setSender($sender);
        $message->setId($id_message + 1);

        $recipients = explode(",", $recip);
        $recipients_array = new ArrayCollection();

        foreach ($recipients as $id_recipient) {
            $recipient = new Recipient();
            $user = $this->getEntityManager()->find("App\Entity\User", $id_recipient);
            $recipient->setIdUsers($user);
            $recipient->setIdMessages($message);
            $recipients_array->add($recipient);
        }

        $message->setRecipients($recipients_array);

        $attachments = new ArrayCollection();
        foreach ($files as $file) {
            $att = new Attachment($file);
            $att->setMessage($message);
            $attachments->add($att);
        }

        $message->setAttachments($attachments);

        try {
            $this->getEntityManager()->persist($message);
            $this->getEntityManager()->flush();
        } catch (ORMException $e) {
            echo "There are an error";
        }


    }

    public function showIndex($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('id')
            ->from('message')
            ->innerJoin('recipient')
            ->where('');
    }
}