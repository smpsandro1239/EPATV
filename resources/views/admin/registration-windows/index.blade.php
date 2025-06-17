@extends('layouts.app')

    @section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Janelas de Registro</h1>
        <a href="{{ route('registration-windows.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md mb-4 inline-block">Nova Janela</a>
        <table class="w-full bg-white rounded-lg shadow">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4">Ativa</th>
                    <th class="p-4">Início</th>
                    <th class="p-4">Fim</th>
                    <th class="p-4">Máx. Registos</th>
                    <th class="p-4">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($windows as $window)
                    <tr>
                        <td class="p-4">{{ $window->is_active ? 'Sim' : 'Não' }}</td>
                        <td class="p-4">{{ $window->start_time->format('d/m/Y H:i') }}</td>
                        <td class="p-4">{{ $window->end_time->format('d/m/Y H:i') }}</td>
                        <td class="p-4">{{ $window->max_registrations }}</td>
                        <td class="p-4">
                            <a href="{{ route('registration-windows.edit', $window) }}" class="text-blue-600">Editar</a>
                            <form action="{{ route('registration-windows.destroy', $window) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $windows->links() }}
    </div>
    @endsection
