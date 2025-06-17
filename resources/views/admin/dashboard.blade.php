@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Painel Administrativo</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Total de Usuários</h2>
            <p class="text-2xl">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Total de Vagas</h2>
            <p class="text-2xl">{{ $stats['total_jobs'] }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Total de Candidaturas</h2>
            <p class="text-2xl">{{ $stats['total_applications'] }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold">Empresas Pendentes</h2>
            <p class="text-2xl">{{ $stats['pending_companies'] }}</p>
        </div>
    </div>
    <h2 class="text-2xl font-bold mb-4">Vagas Recentes</h2>
    <div class="bg-white p-6 rounded shadow">
        @foreach($recent_jobs as $job)
            <p>{{ $job->title }} - {{ $job->company->company_name }}</p>
        @endforeach
    </div>
    <h2 class="text-2xl font-bold mb-4">Candidaturas Recentes</h2>
    <div class="bg-white p-6 rounded shadow">
        @foreach($recent_applications as $application)
            <p>{{ $application->user->name }} - {{ $application->job->title }}</p>
        @endforeach
    </div>
</div>
@endsection
