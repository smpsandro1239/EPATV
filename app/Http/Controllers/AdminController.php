<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin,admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_jobs' => Job::count(),
            'total_applications' => JobApplication::count(),
            'pending_companies' => User::where('role', 'company')->where('registration_status', 'pending')->count(),
        ];

        $recent_jobs = Job::with('company')->latest()->take(5)->get();
        $recent_applications = JobApplication::with(['user', 'job'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_jobs', 'recent_applications'));
    }

    public function manageCompanies()
    {
        $companies = User::where('role', 'company')->paginate(10);
        return view('admin.companies', compact('companies'));
    }

    public function approveCompany(User $user)
    {
        if ($user->role !== 'company' || $user->registration_status === 'approved') {
            return back()->with('error', 'Não é possível aprovar esta empresa.');
        }

        $user->update(['registration_status' => 'approved']);
        return back()->with('success', 'Empresa aprovada com sucesso!');
    }

    public function rejectCompany(User $user)
    {
        if ($user->role !== 'company' || $user->registration_status !== 'pending') {
            return back()->with('error', 'Não é possível rejeitar esta empresa.');
        }

        $user->update(['registration_status' => 'rejected']);
        return back()->with('success', 'Empresa rejeitada com sucesso!');
    }
}