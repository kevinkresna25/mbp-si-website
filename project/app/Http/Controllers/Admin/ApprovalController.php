<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApprovalService;

class ApprovalController extends Controller
{
    public function __construct(
        private ApprovalService $approvalService,
    ) {}

    /**
     * Display the approval queue.
     */
    public function index()
    {
        $pendingCount = $this->approvalService->getPendingCount();

        return view('admin.approval.index', compact('pendingCount'));
    }
}
