<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this import

class SavedJobController extends Controller
{
    public function store(Request $request, Job $job)
    {
        SavedJob::firstOrCreate([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
        ]);

        return back()->with('success', 'Vaga salva com sucesso!');
    }

    public function destroy(Request $request, Job $job)
    {
        SavedJob::where('user_id', Auth::id())->where('job_id', $job->id)->delete();
        return back()->with('success', 'Vaga removida dos favoritos!');
    }
}
