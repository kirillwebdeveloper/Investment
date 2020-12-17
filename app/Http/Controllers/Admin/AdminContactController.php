<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Company;
use App\Entity\ContactMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyRequest;
use App\Repository\CompanyRepository;
use App\Repository\Contact\ContactMessageRepository;
use App\Service\Repository\BaseRepository;

class AdminContactController extends Controller
{
    public function index(BaseRepository $baseRepository)
    {
        return view('admin.contact.index', [
            'messages' => $baseRepository->get(ContactMessageRepository::class)->getAllMessagesPaginated()
        ]);
    }

    public function view(ContactMessage $message)
    {
        return view('admin.contact.view', compact('message'));
    }

    public function delete(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin_contact_index');
    }
}
