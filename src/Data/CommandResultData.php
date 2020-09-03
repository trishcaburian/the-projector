<?php
namespace App\Data;

class CommandResultData
{
    public $isValid;
    private $message_list = [];

    public function setMessageList($message_list)
    {
        $this->message_list = $message_list;
    }

    public function addMessage($message)
    {
        array_push($this->message_list, ['message' => $message]);
    }

    public function getMessages()
    {
        return $this->message_list;
    }
}