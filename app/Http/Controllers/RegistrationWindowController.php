<?php

namespace App\Http\Controllers;

use App\Models\RegistrationWindow;
use Illuminate\Http\Request;

class RegistrationWindowController extends Controller
{
    public function index()
    {
        $windows = RegistrationWindow::latest()->paginate(10);
        return view('admin.registration-windows.index', compact('windows'));
    }

    public function create()
    {
        return view('admin.registration-windows.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'is_active' => 'required|boolean',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'max_registrations' => 'required|integer|min:1',
            'password' => 'nullable|string|min:6',
        ]);

        RegistrationWindow::create($request->all());

        return redirect()->route('registration-windows.index')->with('success', 'Janela de registro criada!');
    }

    public function edit(RegistrationWindow $registrationWindow)
    {
        return view('admin.registration-windows.edit', compact('registrationWindow'));
    }

    public function update(Request $request, RegistrationWindow $registrationWindow)
    {
        $request->validate([
            'is_active' => 'required|boolean',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'max_registrations' => 'required|integer|min:1',
            'password' => 'nullable|string|min:6',
        ]);

        $registrationWindow->update($request->all());

        return redirect()->route('registration-windows.index')->with('success', 'Janela de registro atualizada!');
    }

    public function destroy(RegistrationWindow $registrationWindow)
    {
        $registrationWindow->delete();
        return redirect()->route('registration-windows.index')->with('success', 'Janela de registro eliminada!');
    }
}
