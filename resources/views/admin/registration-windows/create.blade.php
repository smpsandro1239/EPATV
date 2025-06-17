@extends('layouts.app')

    @section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Criar Janela de Registro</h1>
        <form method="POST" action="{{ route('registration-windows.store') }}">
            @csrf
            <div class="mb-4">
                <label for="is_active" class="block text-sm font-medium text-gray-700">Ativa</label>
                <input type="checkbox" id="is_active" name="is_active" value="1" class="mt-1">
            </div>
            <div class="mb-4">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Início</label>
                <input type="datetime-local" id="start_time" name="start_time" required class="mt-1 block w-full border rounded-md p-2">
            </div>
            <div class="mb-4">
                <label for="end_time" class="block text-sm font-medium text-gray-700">Fim</label>
                <input type="datetime-local" id="end_time" name="end_time" required class="mt-1 block w-full border rounded-md p-2">
            </div>
            <div class="mb-4">
                <label for="max_registrations" class="block text-sm font-medium text-gray-700">Máx. Registos</label>
                <input type="number" id="max_registrations" name="max_registrations" value="30" required class="mt-1 block w-full border rounded-md p-2">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border rounded-md p-2">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Criar</button>
        </form>
    </div>
    @endsection
