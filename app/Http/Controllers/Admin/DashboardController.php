<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Determine dashboard view based on role
        if ($user->hasRole('Super Admin')) {
            return view('superadmin.dashboard');
        } elseif ($user->hasRole('Admin')) {
            return view('admin.dashboard');
        } elseif ($user->hasRole('Marketing')) {
            return view('marketing.dashboard');
        }

        // Default fallback
        return view('admin.dashboard');
    }
}
