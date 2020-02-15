<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message_index", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

        $messages = $this->getDoctrine()
            ->getRepository(Message::class)->showIndex($user);


        return $this->render('message/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @Route("/new", name="message_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $message = new Message();

        $entityManager = $this->getDoctrine()->getManager();

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $attachments = $form['attachments']->getData();
            $recipients = $form['recipients']->getData();

            $files = [];
            foreach ($attachments as $attach) {
                array_push($files, $fileUploader->upload($attach));
            }

            $conn = $this->getDoctrine()->getConnection();
            $metadata = $entityManager->getClassMetadata('\App\Entity\Message');
            $seqName = $metadata->getSequenceName($conn->getDatabasePlatform());
            $id_message = $conn->lastInsertId($seqName);


            $this->getDoctrine()->getRepository(Message::class)->perisistMessage($message, $user, $files, $recipients, $id_message);

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
            'users' => $users,
        ]);
    }

    /**
     * @Route("/{id}", name="message_show", methods={"GET"})
     */
    public function show(Message $message): Response
    {
        $attachs = $message->getAttachments();
        $attach_route = [];

        foreach ($attachs as $attach) {
            array_push($attach_route, $attach->getRute());
        }

        return $this->render('message/show.html.twig', [
            'message' => $message,
            'attachs' => $attach_route,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('message_index');
    }
}
