<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $gurus         = User::where('role', 'guru')->count();
        $guruThisMonth = User::where('role', 'guru')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        return view('pages.admin.dashboard.index', compact([
            'gurus', 'guruThisMonth',
        ]));
    }
}
