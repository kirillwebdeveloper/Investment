<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\AdminEmailContact;
use App\Repository\Pipedrive\OrganisationRepository;
use App\Service\Manager\Contact\ContactMessageManager;
use App\Service\Pipedrive\CustomPipeDrive;
use App\Service\Repository\BaseRepository;
use Artesaos\SEOTools\Facades\SEOMeta;
use Devio\Pipedrive\Pipedrive;
use Devio\Pipedrive\PipedriveFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->baseRepository = $baseRepository;
    }

    public function contact()
    {
        SEOMeta::setTitle('Kontakta oss | Investeraravdrag.se');

        return view('contact.contact');
    }

    public function contactPost(
        ContactRequest $contactRequest,
        CustomPipeDrive $pipeDrive,
        ContactMessageManager $contactMessageManager
    )
    {
        Mail::send(new AdminEmailContact($contactRequest));

        $contactMessageManager->saveToContacts($contactRequest);

        return json_encode($pipeDrive->createDeal($contactRequest));
    }

    public function contactSuccess(Request $request)
    {
        SEOMeta::setTitle('Thank you.');

        if (url()->previous() ==  route('contact-post')) {
            return view('contact.success');
        }
        return redirect()->route('contact');
    }
}
