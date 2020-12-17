<?php

namespace App\Service\Manager\Contact;

use App\Entity\ContactMessage;
use App\Http\Requests\ContactRequest;
use App\Repository\Contact\ContactMessageRepository;
use App\Service\Repository\BaseRepository;

class ContactMessageManager
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var ContactMessageRepository
     */
    protected $contactMessageRepository;

    /**
     * ContactMessageManager constructor.
     * @param BaseRepository $baseRepository
     */
    public function __construct(BaseRepository $baseRepository)
    {
        $this->baseRepository           = $baseRepository;
        $this->contactMessageRepository = $baseRepository->get(ContactMessageRepository::class);
    }

    public function saveToContacts(ContactRequest $contactRequest)
    {
        $contactMessage = ContactMessage::create([
            'name'           => $contactRequest->input('name'),
            'email'          => $contactRequest->input('email'),
            'phone'          => $contactRequest->input('phone'),
            'radio_selected' => $contactRequest->input('radio-selected'),
            'message'        => $contactRequest->input('message'),
            'is_new'         => true,
        ]);
    }

    public function getUnread()
    {
        return $this->contactMessageRepository->getAllUnreadMessages();
    }

    public function setReadAll()
    {
        return $this->contactMessageRepository->setAllReadMessages();
    }
}
