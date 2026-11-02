<!doctype html>
<html lang="pt-BR" class="h-full dark">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CyberGuardian - Simulador de Phishing</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              brand: { 500: "#0284c7", 600: "#0284c7" },
            },
          },
        },
      };
    </script>
    <!-- Chart.js para os gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FontAwesome para ícones -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body
    class="h-full font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 flex flex-col transition-colors duration-300"
  >
    <!-- Cabeçalho Principal -->
    <header
      class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 sticky top-0 z-50 shadow-sm"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <!-- Logo & Título -->
          <div class="flex items-center gap-3">
            <div class="p-2 bg-indigo-600 rounded-lg text-white shadow-md">
              <i class="fa-solid fa-shield-halved text-xl"></i>
            </div>
            <div>
              <h1
                class="text-lg font-bold tracking-tight text-slate-900 dark:text-white"
              >
                CyberGuardian
              </h1>
              <p class="text-xs text-slate-500 dark:text-slate-400">
                Simulador de Phishing & Conscientização
              </p>
            </div>
          </div>

          <!-- Controles: Abas e Alternador de Tema -->
          <div class="flex items-center gap-3">
            <nav
              class="flex space-x-1 sm:space-x-2 bg-slate-100 dark:bg-slate-800/60 p-1 rounded-xl border border-slate-200 dark:border-slate-700/50"
            >
              <button
                onclick="switchTab('simulator')"
                id="nav-simulator"
                class="px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition-all duration-200 flex items-center gap-2 bg-indigo-600 text-white shadow-sm"
              >
                <i class="fa-solid fa-envelope-open-text"></i>
                <span class="hidden sm:inline">Simulador</span>
              </button>
              <button
                onclick="switchTab('dashboard')"
                id="nav-dashboard"
                class="px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-2"
              >
                <i class="fa-solid fa-chart-pie"></i>
                <span class="hidden sm:inline">Dashboard</span>
              </button>
              <button
                onclick="switchTab('php-code')"
                id="nav-php-code"
                class="px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-2"
              >
                <i class="fa-solid fa-code"></i>
                <span class="hidden sm:inline">PHP Backend</span>
              </button>
            </nav>

            <!-- Botão de Alternar Tema (Dark/Light) -->
            <button
              onclick="toggleDarkMode()"
              class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 transition-all"
              title="Alternar Tema Claro/Escuro"
            >
              <i id="theme-icon" class="fa-solid fa-sun"></i>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <!-- ABA 1: SIMULADOR DE EMAIL (QUIZ) -->
      <section id="tab-simulator" class="space-y-6">
        <div
          class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm"
        >
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <span
              class="text-xs font-semibold uppercase text-slate-500 tracking-wider"
              >Progresso:</span
            >
            <div
              class="flex-1 sm:w-48 bg-slate-100 dark:bg-slate-800 rounded-full h-2.5 overflow-hidden border border-slate-200 dark:border-slate-700"
            >
              <div
                id="progress-bar"
                class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300"
                style="width: 20%"
              ></div>
            </div>
            <span
              id="step-counter"
              class="text-xs font-bold text-slate-700 dark:text-slate-300"
              >Cenário 1 de 5</span
            >
          </div>
          <button
            onclick="resetQuiz()"
            class="text-xs text-slate-500 hover:text-rose-600 dark:hover:text-rose-400 transition-colors flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-800"
          >
            <i class="fa-solid fa-rotate-right"></i> Reiniciar Teste
          </button>
        </div>

        <!-- Caixa de E-mail Simulada -->
        <div
          class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-xl flex flex-col"
        >
          <div
            class="bg-slate-100 dark:bg-slate-850 border-b border-slate-200 dark:border-slate-800 px-4 py-3 flex items-center justify-between"
          >
            <div class="flex items-center space-x-2">
              <div class="w-3 h-3 rounded-full bg-rose-500"></div>
              <div class="w-3 h-3 rounded-full bg-amber-500"></div>
              <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
              <span
                class="ml-2 text-xs font-mono text-slate-500 dark:text-slate-400"
                >INBOX // SEGURANÇA</span
              >
            </div>
            <span
              class="px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-500/20"
            >
              Ambiente Controlado
            </span>
          </div>

          <div
            class="p-6 border-b border-slate-100 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-900/50 space-y-3"
          >
            <div
              class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 text-sm"
            >
              <div class="flex items-center gap-2">
                <span
                  class="text-xs font-semibold text-slate-400 uppercase w-16"
                  >De:</span
                >
                <span
                  id="email-sender"
                  class="font-mono text-slate-800 dark:text-slate-200 font-semibold bg-white dark:bg-slate-800 px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700 text-xs sm:text-sm"
                  >--</span
                >
              </div>
              <span id="email-date" class="text-xs text-slate-400 font-mono"
                >--</span
              >
            </div>
            <div class="flex items-center gap-2 text-sm">
              <span class="text-xs font-semibold text-slate-400 uppercase w-16"
                >Assunto:</span
              >
              <h2
                id="email-subject"
                class="font-bold text-slate-900 dark:text-slate-100 text-base sm:text-lg"
              >
                --
              </h2>
            </div>
          </div>

          <div
            class="p-6 text-slate-700 dark:text-slate-300 space-y-4 text-sm sm:text-base leading-relaxed bg-white dark:bg-slate-900/30 min-h-[160px]"
          >
            <div id="email-body">--</div>
            <div class="pt-4 pb-2">
              <button
                onclick="userClickedLink()"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-all shadow-md active:scale-95"
              >
                <i class="fa-solid fa-link text-indigo-200"></i>
                <span id="email-link-text">Acessar Link do E-mail</span>
              </button>
            </div>
          </div>

          <div
            class="bg-slate-50 dark:bg-slate-850 p-4 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4"
          >
            <div
              class="text-xs text-slate-500 dark:text-slate-400 text-center sm:text-left"
            >
              <span class="font-bold text-slate-700 dark:text-slate-300"
                >Sua avaliação:</span
              >
              Este e-mail é confiável ou uma ameaça?
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
              <button
                onclick="userEvaluated('legitimo')"
                class="flex-1 sm:flex-initial bg-emerald-600/10 hover:bg-emerald-600 text-emerald-700 dark:text-emerald-300 hover:text-white border border-emerald-500/30 font-semibold px-4 py-2 rounded-lg text-xs sm:text-sm transition-all flex items-center justify-center gap-2"
              >
                <i class="fa-solid fa-circle-check"></i> É Legítimo
              </button>
              <button
                onclick="userEvaluated('phishing')"
                class="flex-1 sm:flex-initial bg-rose-600/10 hover:bg-rose-600 text-rose-700 dark:text-rose-300 hover:text-white border border-rose-500/30 font-semibold px-4 py-2 rounded-lg text-xs sm:text-sm transition-all flex items-center justify-center gap-2"
              >
                <i class="fa-solid fa-triangle-exclamation"></i> É Phishing
              </button>
            </div>
          </div>
        </div>

        <!-- Card de Explicação -->
        <div
          id="explanation-card"
          class="hidden rounded-xl p-6 border-2 transition-all space-y-4 shadow-md"
        >
          <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-3">
              <div id="explanation-icon" class="p-3 rounded-xl text-2xl"></div>
              <div>
                <h3 id="explanation-title" class="text-lg font-bold">--</h3>
                <p
                  id="explanation-subtitle"
                  class="text-xs sm:text-sm text-slate-600 dark:text-slate-300"
                >
                  --
                </p>
              </div>
            </div>
          </div>
          <div class="border-t border-slate-200 dark:border-slate-700/50 pt-4">
            <h4
              class="text-xs uppercase tracking-wider font-bold text-slate-500 dark:text-slate-400 mb-3"
            >
              Análise de Micro-Detalhes:
            </h4>
            <ul
              id="explanation-points"
              class="space-y-2 text-sm text-slate-700 dark:text-slate-300"
            ></ul>
          </div>
          <div class="pt-2 flex justify-end">
            <button
              onclick="nextScenario()"
              class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg text-sm transition-all flex items-center gap-2 shadow-sm"
            >
              <span id="next-btn-text">Próximo E-mail</span>
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </section>

      <!-- ABA 2: DASHBOARD -->
      <section id="tab-dashboard" class="hidden space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-xl flex items-center justify-between shadow-sm"
          >
            <div>
              <p class="text-xs text-slate-500 uppercase font-semibold">
                Phishing Clicados
              </p>
              <h3
                id="dash-clicked-phishing"
                class="text-2xl font-extrabold text-rose-600 dark:text-rose-500 mt-1"
              >
                0/0
              </h3>
            </div>
            <div
              class="p-3 bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-xl border border-rose-100 dark:border-rose-500/20"
            >
              <i class="fa-solid fa-user-ninja text-xl"></i>
            </div>
          </div>
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-xl flex items-center justify-between shadow-sm"
          >
            <div>
              <p class="text-xs text-slate-500 uppercase font-semibold">
                Taxa de Acertos
              </p>
              <h3
                id="dash-accuracy"
                class="text-2xl font-extrabold text-indigo-600 dark:text-indigo-400 mt-1"
              >
                0%
              </h3>
            </div>
            <div
              class="p-3 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-xl border border-indigo-100 dark:border-indigo-500/20"
            >
              <i class="fa-solid fa-bullseye text-xl"></i>
            </div>
          </div>
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-xl flex items-center justify-between shadow-sm"
          >
            <div>
              <p class="text-xs text-slate-500 uppercase font-semibold">
                Legítimos Confiados
              </p>
              <h3
                id="dash-legit-trusted"
                class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-1"
              >
                0/0
              </h3>
            </div>
            <div
              class="p-3 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl border border-emerald-100 dark:border-emerald-500/20"
            >
              <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
          </div>
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 rounded-xl flex items-center justify-between shadow-sm"
          >
            <div>
              <p class="text-xs text-slate-500 uppercase font-semibold">
                Total Testados
              </p>
              <h3
                id="dash-total-tested"
                class="text-2xl font-extrabold text-slate-800 dark:text-slate-200 mt-1"
              >
                0
              </h3>
            </div>
            <div
              class="p-3 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-xl border border-slate-200 dark:border-slate-700"
            >
              <i class="fa-solid fa-inbox text-xl"></i>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-xl flex flex-col justify-between shadow-sm"
          >
            <h3
              class="font-bold text-slate-800 dark:text-slate-200 mb-4 text-base"
            >
              Desempenho Geral
            </h3>
            <div class="relative flex items-center justify-center h-64">
              <canvas id="chart-performance"></canvas>
            </div>
          </div>
          <div
            class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-xl flex flex-col justify-between shadow-sm"
          >
            <h3
              class="font-bold text-slate-800 dark:text-slate-200 mb-4 text-base"
            >
              Análise de Riscos
            </h3>
            <div class="relative flex items-center justify-center h-64">
              <canvas id="chart-details"></canvas>
            </div>
          </div>
        </div>

        <div
          class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-xl space-y-4 shadow-sm"
        >
          <h3
            class="font-bold text-slate-800 dark:text-slate-200 text-base flex items-center gap-2"
          >
            <i
              class="fa-solid fa-user-shield text-indigo-600 dark:text-indigo-400"
            ></i>
            Relatório do CyberGuardian
          </h3>
          <div
            id="security-diagnosis"
            class="p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 text-sm text-slate-600 dark:text-slate-300"
          >
            Realize o teste para gerar seu perfil de segurança.
          </div>
        </div>
      </section>

      <!-- ABA 3: CODIGO PHP -->
      <section id="tab-php-code" class="hidden space-y-4">
        <div
          class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 rounded-xl flex items-center justify-between shadow-sm"
        >
          <div>
            <h3 class="font-bold text-slate-800 dark:text-slate-200 text-sm">
              Arquivo Backend PHP (`index.php`)
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400">
              Código responsável pelo processamento de sessões no servidor
              local.
            </p>
          </div>
          <button
            onclick="alert('Copie o código do bloco abaixo!')"
            class="bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold px-4 py-2 rounded-lg text-xs transition-all border border-slate-200 dark:border-slate-700"
          >
            <i class="fa-regular fa-copy"></i> Copiar
          </button>
        </div>
        <div
          class="bg-slate-900 border border-slate-800 rounded-xl p-4 font-mono text-xs text-slate-300 overflow-x-auto max-h-[500px]"
        >
          <pre><code>&lt;?php
session_start();
// CyberGuardian PHP Backend Engine
if (!isset($_SESSION['stats'])) {
    $_SESSION['stats'] = ['clicks' => 0, 'total' => 0];
}
// Gestão de submissões e rastreio de phishing
$acao = $_GET['acao'] ?? null;
if ($acao) {
    $_SESSION['stats']['total']++;
}
?&gt;</code></pre>
        </div>
      </section>
    </main>

    <!-- Script de Comportamento e Cenários Convincentes -->
    <script>
      // Cenários com e-mails reais e mudanças extremamente sutis (Phishing realista vs Legítimo)
      const emails = [
        {
          id: 1,
          tipo: "phishing",
          remetente: "Netflix <suporte@netfl1x-atendimento.com>",
          assunto: "Aviso importante sobre o seu plano de assinatura",
          data: "Hoje, 11:15",
          corpo:
            "Olá, Notamos um problema com as informações de cobrança atuais da sua conta. Precisamos que você confirme seus dados para evitar interrupções no acesso aos seus filmes e séries favoritos.<br><br>Atualize seu método de pagamento pelo link abaixo:",
          linkTexto: "Atualizar Dados na Netflix",
          explicacao: {
            titulo: "⚠️ CUIDADO! Golpe de Phishing muito sutil!",
            subtitulo: "Este e-mail imita perfeitamente o design da Netflix.",
            pontos: [
              {
                label: "Domínio Sutilmente Alterado:",
                desc: 'Note o número "1" no lugar da letra "i" em "netfl1x-atendimento.com".',
              },
              {
                label: "Urgência na Cobrança:",
                desc: "Usa a ameaça de cancelamento do lazer para fazer você clicar sem pensar.",
              },
            ],
          },
        },
        {
          id: 2,
          tipo: "legitimo",
          remetente: "Mercado Livre <contato@mercadolivre.com>",
          assunto: "Sua compra #2000009823 foi enviada!",
          data: "Hoje, 09:30",
          corpo:
            "Olá! Boas notícias: o seu produto já está a caminho com a nossa transportadora parceira. Você pode acompanhar cada etapa da entrega diretamente em sua conta oficial.<br><br>Obrigado por comprar conosco!",
          linkTexto: "Acompanhar Envio na sua Conta",
          explicacao: {
            titulo: "✅ SEGURO! E-mail Legítimo!",
            subtitulo:
              "Trata-se de uma confirmação real de envio de mercadoria.",
            pontos: [
              {
                label: "Remetente Oficial:",
                desc: "Domínio autêntico @mercadolivre.com sem caracteres trocados.",
              },
              {
                label: "Sem Pedido de Senha:",
                desc: "Apenas informa sobre um pedido real sem pedir dados de cartão ou credenciais.",
              },
            ],
          },
        },
        {
          id: 3,
          tipo: "phishing",
          remetente: "iFood Benefícios <cartao@ifood-beneficios-online.net>",
          assunto: "Sua via física do cartão iFood Benefícios foi emitida",
          data: "Ontem, 16:45",
          corpo:
            "Informamos que a nova via do seu cartão de benefícios corporativo foi gerada. Para desbloquear e confirmar o endereço de entrega, acesse o painel de validação cadastral:",
          linkTexto: "Confirmar Endereço de Entrega",
          explicacao: {
            titulo: "⚠️ CUIDADO! Phishing corporativo simulando iFood!",
            subtitulo:
              "Aproveita-se de benefícios de vale-refeição para enganar colaboradores.",
            pontos: [
              {
                label: "Domínio Externo Falso:",
                desc: 'Usa "@ifood-beneficios-online.net" em vez do domínio oficial da marca.',
              },
              {
                label: "Isso de Engenharia Social:",
                desc: "Assuntos corporativos atraem atenção rápida de funcionários.",
              },
            ],
          },
        },
        {
          id: 4,
          tipo: "legitimo",
          remetente: "Amazon.com.br <auto-confirm@amazon.com.br>",
          assunto: "Confirmação do seu pedido Amazon",
          data: "Ontem, 14:10",
          corpo:
            "Agradecemos seu pedido! Estamos processando o item selecionado. Você receberá uma nova mensagem assim que o pacote for despachado para o seu endereço.",
          linkTexto: "Ver Detalhes do Pedido",
          explicacao: {
            titulo: "✅ SEGURO! E-mail Genuíno da Amazon!",
            subtitulo: "Confirmação padrão de transação comercial.",
            pontos: [
              {
                label: "Domínio Oficial Verificado:",
                desc: "Enviado por @amazon.com.br com assinaturas de segurança ativas.",
              },
              {
                label: "Informativo e Direto:",
                desc: "Sem ameaças nem links maliciosos externos.",
              },
            ],
          },
        },
        {
          id: 5,
          tipo: "phishing",
          remetente: "Nubank <nao-responda@nu-atendimento-seguro.com>",
          assunto: "Alerta: Tentativa de Acesso Bloqueada em Novo Aparelho",
          data: "Há 2 dias",
          corpo:
            "Identificamos um acesso suspeito à sua conta vindo de Curitiba/PR. Caso não tenha sido você, confirme sua identidade imediatamente para proteger seus fundos:",
          linkTexto: "Desbloquear e Validar Minha Conta",
          explicacao: {
            titulo: "⚠️ CUIDADO! Golpe bancário sofisticado!",
            subtitulo:
              "Simula alertas de segurança do Nubank para gerar pânico imediato.",
            pontos: [
              {
                label: "Falso Domínio Bancário:",
                desc: 'Bancos nunca enviam links diretos do tipo "nu-atendimento-seguro.com".',
              },
              {
                label: "Tática de Pânico:",
                desc: "Usa localização falsa para assustar o correntista.",
              },
            ],
          },
        },
      ];

      let currentIndex = 0;
      let stats = {
        phishingTotal: 0,
        phishingClicked: 0,
        phishingIdentified: 0,
        legitTotal: 0,
        legitTrusted: 0,
        legitMarkedPhishing: 0,
        evaluated: new Set(),
      };
      let chartPerf = null,
        chartDet = null;

      document.addEventListener("DOMContentLoaded", () => {
        renderScenario();
        initCharts();
      });

      function toggleDarkMode() {
        const html = document.documentElement;
        const icon = document.getElementById("theme-icon");
        if (html.classList.contains("dark")) {
          html.classList.remove("dark");
          icon.className = "fa-solid fa-moon";
        } else {
          html.classList.add("dark");
          icon.className = "fa-solid fa-sun";
        }
      }

      function switchTab(tabId) {
        ["simulator", "dashboard", "php-code"].forEach((id) => {
          document.getElementById(`tab-${id}`).classList.add("hidden");
          document.getElementById(`nav-${id}`).className =
            "px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-2";
        });
        document.getElementById(`tab-${tabId}`).classList.remove("hidden");
        document.getElementById(`nav-${tabId}`).className =
          "px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition-all flex items-center gap-2 bg-indigo-600 text-white shadow-sm";
        if (tabId === "dashboard") updateDashboard();
      }

      function renderScenario() {
        const email = emails[currentIndex];
        document.getElementById("explanation-card").classList.add("hidden");
        document.getElementById("step-counter").innerText =
          `Cenário ${currentIndex + 1} de ${emails.length}`;
        document.getElementById("progress-bar").style.width =
          `${((currentIndex + 1) / emails.length) * 100}%`;
        document.getElementById("email-sender").innerText = email.remetente;
        document.getElementById("email-date").innerText = email.data;
        document.getElementById("email-subject").innerText = email.assunto;
        document.getElementById("email-body").innerHTML = email.corpo;
        document.getElementById("email-link-text").innerText = email.linkTexto;
        document.getElementById("next-btn-text").innerText =
          currentIndex === emails.length - 1
            ? "Ver Resultado"
            : "Próximo E-mail";
      }

      function userClickedLink() {
        handleAnswer("clicou");
      }

      function userEvaluated(decision) {
        handleAnswer(decision);
      }

      function handleAnswer(action) {
        const email = emails[currentIndex];
        if (!stats.evaluated.has(email.id)) {
          stats.evaluated.add(email.id);
          if (email.tipo === "phishing") {
            stats.phishingTotal++;
            if (action === "clicou" || action === "legitimo")
              stats.phishingClicked++;
            if (action === "phishing") stats.phishingIdentified++;
          } else {
            stats.legitTotal++;
            if (action === "legitimo") stats.legitTrusted++;
            if (action === "phishing") stats.legitMarkedPhishing++;
          }
        }
        showExplanation(action);
      }

      function showExplanation(action) {
        const email = emails[currentIndex];
        const card = document.getElementById("explanation-card");
        const icon = document.getElementById("explanation-icon");
        const title = document.getElementById("explanation-title");
        const subtitle = document.getElementById("explanation-subtitle");
        const pointsList = document.getElementById("explanation-points");

        card.classList.remove("hidden");
        if (email.tipo === "phishing") {
          card.className =
            "rounded-xl p-6 border-2 bg-rose-50 dark:bg-rose-950/30 border-rose-500/50 space-y-4 shadow-md";
          icon.className =
            "p-3 rounded-xl text-2xl bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-500/30";
          icon.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';
          title.className =
            "text-lg font-bold text-rose-800 dark:text-rose-300";
          title.innerText = email.explicacao.titulo;
          subtitle.innerHTML =
            action === "clicou"
              ? "<strong class='text-rose-600'>Você caiu no Phishing!</strong>"
              : "<strong class='text-emerald-600'>Excelente!</strong> Identificado com sucesso.";
        } else {
          card.className =
            "rounded-xl p-6 border-2 bg-emerald-50 dark:bg-emerald-950/30 border-emerald-500/50 space-y-4 shadow-md";
          icon.className =
            "p-3 rounded-xl text-2xl bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30";
          icon.innerHTML = '<i class="fa-solid fa-shield-check"></i>';
          title.className =
            "text-lg font-bold text-emerald-800 dark:text-emerald-300";
          title.innerText = email.explicacao.titulo;
          subtitle.innerHTML =
            action === "phishing"
              ? "<strong class='text-amber-600'>Falso Alarme!</strong> Este e-mail era legítimo."
              : "<strong class='text-emerald-600'>Correto!</strong> E-mail autêntico reconhecido.";
        }

        pointsList.innerHTML = "";
        email.explicacao.pontos.forEach((p) => {
          const li = document.createElement("li");
          li.className =
            "flex items-start gap-2 text-sm text-slate-700 dark:text-slate-300";
          li.innerHTML = `<span class="font-bold whitespace-nowrap">• ${p.label}</span> <span>${p.desc}</span>`;
          pointsList.appendChild(li);
        });
        card.scrollIntoView({ behavior: "smooth", block: "nearest" });
      }

      function nextScenario() {
        if (currentIndex < emails.length - 1) {
          currentIndex++;
          renderScenario();
        } else {
          switchTab("dashboard");
        }
      }

      function resetQuiz() {
        currentIndex = 0;
        stats = {
          phishingTotal: 0,
          phishingClicked: 0,
          phishingIdentified: 0,
          legitTotal: 0,
          legitTrusted: 0,
          legitMarkedPhishing: 0,
          evaluated: new Set(),
        };
        renderScenario();
        updateDashboard();
      }

      function initCharts() {
        const ctx1 = document
          .getElementById("chart-performance")
          .getContext("2d");
        chartPerf = new Chart(ctx1, {
          type: "doughnut",
          data: {
            labels: ["Acertos", "Phishing Clicados", "Falsos Alarmes"],
            datasets: [
              {
                data: [0, 0, 0],
                backgroundColor: ["#10b981", "#f43f5e", "#f59e0b"],
                borderWidth: 0,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: "bottom" } },
          },
        });

        const ctx2 = document.getElementById("chart-details").getContext("2d");
        chartDet = new Chart(ctx2, {
          type: "bar",
          data: {
            labels: [
              "Phishing Identificados",
              "Phishing Clicados",
              "Legítimos Confiados",
            ],
            datasets: [
              {
                data: [0, 0, 0],
                backgroundColor: ["#0284c7", "#f43f5e", "#10b981"],
                borderRadius: 6,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
          },
        });
      }

      function updateDashboard() {
        const total = stats.evaluated.size;
        const correct = stats.phishingIdentified + stats.legitTrusted;
        const accuracy = total > 0 ? Math.round((correct / total) * 100) : 0;

        document.getElementById("dash-clicked-phishing").innerText =
          `${stats.phishingClicked}/${stats.phishingTotal}`;
        document.getElementById("dash-accuracy").innerText = `${accuracy}%`;
        document.getElementById("dash-legit-trusted").innerText =
          `${stats.legitTrusted}/${stats.legitTotal}`;
        document.getElementById("dash-total-tested").innerText = total;

        chartPerf.data.datasets[0].data = [
          correct,
          stats.phishingClicked,
          stats.legitMarkedPhishing,
        ];
        chartPerf.update();

        chartDet.data.datasets[0].data = [
          stats.phishingIdentified,
          stats.phishingClicked,
          stats.legitTrusted,
        ];
        chartDet.update();

        const diag = document.getElementById("security-diagnosis");
        if (total === 0)
          diag.innerHTML =
            "Realize os testes no simulador para gerar seu relatório do CyberGuardian.";
        else if (stats.phishingClicked > 0)
          diag.innerHTML = `<strong class='text-rose-500'>Atenção:</strong> Você caiu em ${stats.phishingClicked} armadilhas de phishing. Verifique sempre os domínios dos remetentes com atenção redobrada.`;
        else
          diag.innerHTML = `<strong class='text-emerald-500'>Excelente desempenho!</strong> Sua percepção de segurança está altamente apurada.`;
      }
    </script>
  </body>
</html>
