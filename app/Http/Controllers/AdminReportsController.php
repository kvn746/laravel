<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use App\Services\AdminReportsService;

class AdminReportsController extends Controller
{
    protected $reports;

    public function __construct(AdminReportsService $reports)
    {
        $this->reports = $reports->getReports();
        $this->middleware(Admin::class);
    }

    public function index()
    {
        $reports = $this->reports;
        return view('admin.reports.index', compact('reports'));
    }
}
