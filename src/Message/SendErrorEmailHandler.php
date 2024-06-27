<?php

namespace App\Message;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
final class SendErrorEmailHandler
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(SendErrorEmailMessage $message): void
    {
        $error = sprintf(
            '<h2>Error en la acción "%s" con item "%s" y valor "%s"</h2><p><b>%s</b></p>',
            $message->getStock(),
            $message->getItemName(),
            $message->getItemValue(),
            $message->getError()
        );

        $email = (new Email())
            ->from('anderson.sanchez.toledo@gmail.com')
            ->to('anderson.sanchez.toledo@gmail.com')
            ->subject('Error al guardar información de acción')
            ->html($error);

        $this->mailer->send($email);
    }
}