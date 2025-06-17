@extends('layouts.app')

  @section('content')
  <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-6">Ofertas de Emprego</h1>
      <form class="mb-8 flex flex-wrap gap-4" action="{{ route('jobs.index') }}" method="GET">
          <select name="category_id" class="border rounded-md p-2">
              <option value="">Área de Interesse</option>
              @foreach($areas as $area)
                  <option value="{{ $area->id }}" {{ request('category_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
              @endforeach
          </select>
          <select name="location" class="border rounded-md p-2">
              <option value="">Localização</option>
              <option value="Braga" {{ request('location') == 'Braga' ? 'selected' : '' }}>Braga</option>
              <option value="Barcelos" {{ request('location') == 'Barcelos' ? 'selected' : '' }}>Barcelos</option>
              <option value="Guimarães" {{ request('location') == 'Guimarães' ? 'selected' : '' }}>Guimarães</option>
          </select>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Filtrar</button>
      </form>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($jobs as $job)
              <div class="bg-white p-6 rounded-lg shadow">
                  <h2 class="text-xl font-semibold mb-2">{{ $job->title }}</h2>
                  <p class="text-gray-600 mb-2">{{ $job->company->company_name }}</p>
                  <p class="text-gray-600 mb-2">{{ $job->location }}</p>
                  <p class="text-gray-600 mb-4">{{ $job->category->name }}</p>
                  <a href="{{ route('jobs.show', $job) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">Ver Detalhes</a>
              </div>
          @endforeach
      </div>
      {{ $jobs->links() }}
  </div>
  @endsection
