@extends('layouts.app')

  @section('content')
  <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-4">{{ $job->title }}</h1>
      <div class="bg-white p-6 rounded-lg shadow mb-6">
          <p class="text-gray-600 mb-2"><strong>Empresa:</strong> {{ $job->company->company_name }}</p>
          <p class="text-gray-600 mb-2"><strong>Localização:</strong> {{ $job->location }}</p>
          <p class="text-gray-600 mb-2"><strong>Categoria:</strong> {{ $job->category->name }}</p>
          <p class="text-gray-600 mb-2"><strong>Salário:</strong> {{ $job->salary ? number_format($job->salary, 2) . '€' : 'Não informado' }}</p>
          <p class="text-gray-600 mb-2"><strong>Tipo de Contrato:</strong> {{ ucfirst($job->contract_type) }}</p>
          <p class="text-gray-600 mb-4"><strong>Descrição:</strong> {{ $job->description }}</p>
          @auth
              @if(auth()->user()->role === 'student')
                  <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                      @csrf
                      <div class="mb-4">
                          <label for="cv" class="block text-sm font-medium text-gray-700">CV (PDF)</label>
                          <input type="file" id="cv" name="cv" accept=".pdf" required class="mt-1 block w-full border rounded-md p-2">
                          @error('cv') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                      </div>
                      <div class="mb-4">
                          <label for="message" class="block text-sm font-medium text-gray-700">Mensagem</label>
                          <textarea id="message" name="message" class="mt-1 block w-full border rounded-md p-2"></textarea>
                          @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                      </div>
                      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Candidatar-se</button>
                  </form>
                  <form action="{{ route('jobs.save', $job) }}" method="POST" class="inline">
                      @csrf
                      <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">Salvar Vaga</button>
                  </form>
              @endif
          @else
              <p class="text-gray-600">Faça login para candidatar-se.</p>
          @endauth
      </div>
  </div>
  @endsection
