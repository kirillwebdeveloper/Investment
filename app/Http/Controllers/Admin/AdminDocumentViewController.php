<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Investment;
use App\Http\Controllers\Controller;

class AdminDocumentViewController extends Controller
{
    public function viewDocument(Investment $investment)
    {
        return view('admin.document_view.all', compact('investment'));
    }

    public function viewK11(Investment $investment)
    {
        return view('admin.document_view.k11', compact('investment'));
    }

    public function viewBegaran(Investment $investment)
    {
        return view('admin.document_view.begaran', compact('investment'));
    }

    public function viewKontrolluppgift(Investment $investment)
    {
        return view('admin.document_view.kontrolluppgift', compact('investment'));
    }

    public function viewSammandrag(Investment $investment)
    {
        return view('admin.document_view.sammandrag', compact('investment'));
    }
}
