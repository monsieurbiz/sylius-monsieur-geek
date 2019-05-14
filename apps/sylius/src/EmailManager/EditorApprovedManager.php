<?php

namespace App\EmailManager;

use App\Entity\Editor\EditorInterface;
use Sylius\Component\Mailer\Sender\SenderInterface;

class EditorApprovedManager
{
    private $emailSender;
    
    public function __construct(SenderInterface $emailSender)
    {
        $this->emailSender = $emailSender;
    }
    
    public function sendEmail(EditorInterface $editor): void
    {
        $this->emailSender->send('editor_approved', [$editor->getEmail()], ['editor' => $editor]);
    }
}
