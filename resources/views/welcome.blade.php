<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>EPATV Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <!-- Logo local com tamanho personalizado -->
                <img src="{{ asset('images/epatv_logo.png') }}" alt="EPATV" class="h-[54px] w-auto">
                <span class="text-2xl font-bold text-blue-700"> Empregabilidade</span>
            </div>
            <div class="flex gap-4">
                <a href="#vagas" class="text-gray-700 hover:text-blue-700 font-medium">Ofertas</a>
                <a href="#categorias" class="text-gray-700 hover:text-blue-700 font-medium">Áreas</a>
                <a href="#empresas" class="text-gray-700 hover:text-blue-700 font-medium">Empresas</a>
                <a href="#alunos" class="text-gray-700 hover:text-blue-700 font-medium">Ex-Alunos</a>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Login</a>
                <a href="{{ route('register') }}" class="border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-50 transition">Registar</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="bg-gradient-to-br from-blue-600 to-blue-400 py-16 text-white text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">O teu futuro começa aqui!</h1>
            <p class="text-lg md:text-2xl mb-8">Encontra as melhores oportunidades de emprego, estágios e networking para ex-alunos da EPATV.</p>
            <a href="#vagas" class="bg-white text-blue-600 font-bold px-8 py-3 rounded-full shadow-lg hover:bg-blue-100 transition">Procurar ofertas</a>
        </div>
    </section>

    <!-- PESQUISA DE OFERTAS -->
    <section id="vagas" class="bg-white py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-center">Pesquisa de Ofertas</h2>
            <form class="flex flex-col md:flex-row gap-4 justify-center">
                <input type="text" placeholder="Palavra-chave, empresa ou área..." class="w-full md:w-1/3 px-4 py-2 border rounded">
                <select class="w-full md:w-1/4 px-4 py-2 border rounded">
                    <option>Área de Interesse</option>
                    <option>Programação Informática</option>
                    <option>Design Gráfico</option>
                    <option>Estética</option>
                    <option>...</option>
                </select>
                <select class="w-full md:w-1/4 px-4 py-2 border rounded">
                    <option>Localização</option>
                    <option>Braga</option>
                    <option>Barcelos</option>
                    <option>Guimarães</option>
                    <option>...</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Pesquisar</button>
            </form>
        </div>
    </section>

    <!-- CATEGORIAS EM DESTAQUE -->
    <section id="categorias" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8 text-center">Áreas de Interesse em Destaque</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded shadow text-center hover:bg-blue-50 transition">
                    <span class="text-blue-600 font-bold text-lg">Programação Informática</span>
                </div>
                <div class="bg-white p-6 rounded shadow text-center hover:bg-blue-50 transition">
                    <span class="text-blue-600 font-bold text-lg">Design Gráfico</span>
                </div>
                <div class="bg-white p-6 rounded shadow text-center hover:bg-blue-50 transition">
                    <span class="text-blue-600 font-bold text-lg">Estética</span>
                </div>
                <div class="bg-white p-6 rounded shadow text-center hover:bg-blue-50 transition">
                    <span class="text-blue-600 font-bold text-lg">Cozinha / Pastelaria</span>
                </div>
                <!-- Adicione mais categorias conforme necessário -->
            </div>
        </div>
    </section>

    <!-- SECÇÃO PARA EMPRESAS -->
    <section id="empresas" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-center">Empresas Parceiras</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <div class="bg-gray-100 p-6 rounded shadow text-center w-48">
                    <img src="https://placehold.co/100x100" alt="Empresa 1" class="mx-auto mb-2 rounded-full">
                    <span class="block font-bold">Empresa 1</span>
                    <span class="text-gray-500 text-sm">Tecnologia</span>
                </div>
                <div class="bg-gray-100 p-6 rounded shadow text-center w-48">
                    <img src="https://placehold.co/100x100" alt="Empresa 2" class="mx-auto mb-2 rounded-full">
                    <span class="block font-bold">Empresa 2</span>
                    <span class="text-gray-500 text-sm">Design</span>
                </div>
                <!-- Adicione mais empresas -->
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Sou Empresa - Quero Recrutar</a>
            </div>
        </div>
    </section>

    <!-- SECÇÃO PARA EX-ALUNOS -->
    <section id="alunos" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-center">Ex-Alunos EPATV</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded shadow">
                    <h3 class="font-bold text-lg mb-2 text-blue-700">Procura o teu primeiro emprego?</h3>
                    <p class="mb-4">Regista-te, cria o teu perfil, faz upload do teu currículo e candidata-te às melhores vagas do mercado.</p>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Registar como Ex-Aluno</a>
                </div>
                <div class="bg-white p-8 rounded shadow">
                    <h3 class="font-bold text-lg mb-2 text-blue-700">Já tens conta?</h3>
                    <p class="mb-4">Acede ao teu painel, atualiza o teu perfil, acompanha as tuas candidaturas e descobre novas oportunidades.</p>
                    <a href="{{ route('login') }}" class="border border-blue-600 text-blue-600 px-6 py-2 rounded hover:bg-blue-50 transition">Entrar</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-blue-700 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <!-- Logo local com tamanho personalizado -->
            <img src="{{ asset('images/epatv_logo.png') }}" alt="EPATV" class="h-[54px] w-auto mx-auto mb-2">
            <p class="mb-2">&copy; {{ date('Y') }} EPATV - Escola Profissional Amar Terra Verde. Todos os direitos reservados.</p>
            <p class="text-sm">Desenvolvido para a comunidade EPATV | <a href="mailto:contacto@epatv.pt" class="underline">contacto@epatv.pt</a></p>
        </div>
    </footer>

</body>
</html>
