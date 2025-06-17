<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company', 'category')->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'company') {
            abort(403, 'Apenas empresas podem criar vagas.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:areas_of_interest,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'contract_type' => 'required|in:full-time,part-time,internship,freelance',
            'expiration_date' => 'required|date|after:today',
        ]);

        Job::create([
            'company_id' => Auth::id(),
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'contract_type' => $validated['contract_type'],
            'expiration_date' => $validated['expiration_date'],
        ]);

        return redirect()->route('dashboard');
    }
}
