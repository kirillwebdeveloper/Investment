<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\InvestmentRepository;
use App\Repository\InvestorRepository;
use App\Service\Repository\BaseRepository;

class AdminHomeController extends Controller
{
    public function dashboard(BaseRepository $baseRepository)
    {
        return view('admin.admin_home.dashboard', [
            'investorCount'    => $baseRepository->get(InvestorRepository::class)->getInvestorCount(),
            'investmentsCount' => $baseRepository->get(InvestmentRepository::class)->getInvestmentsCount(),
        ]);
    }
}
