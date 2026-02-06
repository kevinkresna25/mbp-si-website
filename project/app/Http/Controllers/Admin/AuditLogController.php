<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        if ($userId = $request->get('user_id')) {
            $query->where('causer_id', $userId)->where('causer_type', 'App\\Models\\User');
        }

        if ($event = $request->get('event')) {
            $query->where('event', $event);
        }

        if ($from = $request->get('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = $request->get('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $activities = $query->paginate(30)->withQueryString();
        $users = \App\Models\User::orderBy('name')->pluck('name', 'id');

        return view('admin.audit-log.index', compact('activities', 'users'));
    }
}
