<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Notifications\ApplicationReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class JobApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        // Authorize only students
        if (Auth::user()->role !== 'student') {
            return back()->with('error', 'Apenas estudantes podem candidatar-se a vagas.');
        }

        // Check if job is expired
        if ($job->expiration_date && $job->expiration_date < now()) {
            return back()->with('error', 'Esta vaga já expirou.');
        }

        $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        // Check for duplicate application
        if (JobApplication::where('user_id', Auth::id())->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Você já se candidatou a esta vaga.');
        }

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $application = JobApplication::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone ?? '',
            'course_completion_year' => Auth::user()->course_completion_year ?? null,
            'cv' => $cvPath,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        // Notify company if it exists
        if ($job->company) {
            try {
                $job->company->notify(new ApplicationReceived($application));
            } catch (Exception $e) {
                Log::error('Failed to send application notification for job ID ' . $job->id . ', user ID ' . Auth::id() . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Candidatura enviada com sucesso!');
    }
}
