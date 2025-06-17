<h2 class="text-2xl font-bold mb-4">Dashboard da Empresa</h2>
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-2">Suas Vagas</h3>
    @forelse(auth()->user()->jobs as $job)
        <p>{{ $job->title }} - {{ $job->applications->count() }} candidaturas</p>
    @empty
        <p>Nenhuma vaga publicada.</p>
    @endforelse
</div>
