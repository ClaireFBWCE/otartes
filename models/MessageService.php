<?php

class MessageService
{
    public function fillMessage(string $message)
    {
        $_SESSION['message'] = $message;
    }

    public function deleteMessage()
    {
       unset($_SESSION['message']);
    }

    public function getMessage(): string
    {
        if ($this->isMessageFilled())
        {
            return $_SESSION['message'];
        } else {
            return false;
        }
    }

    public function isMessageFilled(): bool
    {
        return isset($_SESSION['message']);
    }

    // public function getAndDeleteMessage()
    // {
    //     // $messageest soit unstring soit false
    //     $message = $this->getMessage();
    //     $this->deleteMessage();

    //     return $message;
    // }
}