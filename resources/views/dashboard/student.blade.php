<h2 class="text-2xl font-bold mb-4">Dashboard do Estudante</h2>
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-2">Suas Candidaturas</h3>
    @forelse(auth()->user()->applications as $application)
        <p>{{ $application->job->title }} - {{ $application->status }}</p>
    @empty
        <p>Nenhuma candidatura submetida.</p>
    @endforelse
</div>
<div class="bg-white p-6 rounded shadow mt-4">
    <h3 class="text-lg font-semibold mb-2">Vagas Salvas</h3>
    @forelse(auth()->user()->savedJobs as $savedJob)
        <p>{{ $savedJob->job->title }}</p>
    @empty
        <p>Nenhuma vaga salva.</p>
    @endforelse
</div>
