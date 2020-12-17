<?php

namespace App\Repository\Contact;

use App\Entity\ContactMessage;
use App\Service\Repository\RepositoryInterface;

class ContactMessageRepository implements RepositoryInterface
{
    public function getAllUnreadMessages()
    {
        return ContactMessage::where([
            'is_new' => true
        ])->get();
    }

    public function getAllMessagesPaginated()
    {
        return ContactMessage::paginate();
    }

    public function setAllReadMessages()
    {
        $messages = ContactMessage::where([
            'is_new' => true
        ])->get();

        foreach ($messages as $message) {
            /** @var $message ContactMessage */
            $message->update([
                'is_new' => false,
            ]);
            $message->save();
        }
    }
}
