<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(): Response
    {
        $userCounts = User::query()
            ->selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        return Inertia::render('admin/Dashboard', [
            'stats' => [
                'totalUsers' => (int) $userCounts->sum(),
                'admins' => (int) $userCounts->get(UserRole::Admin->value, 0),
                'operators' => (int) $userCounts->get(UserRole::Operator->value, 0),
                'regularUsers' => (int) $userCounts->get(UserRole::User->value, 0),
            ],
            'recentUsers' => User::query()
                ->orderByDesc('created_at')
                ->limit(5)
                ->get(['id', 'name', 'email', 'role', 'created_at']),
        ]);
    }
}
