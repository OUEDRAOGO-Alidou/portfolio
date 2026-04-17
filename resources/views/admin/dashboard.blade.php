@extends('layouts.layout')
@include('layouts.sidebar')
@section('content')
<div class="dashboard-container">
    <!-- En-tête avec salutation dynamique -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
        <div>
            <h1 class="display-6 fw-bold gradient-text mb-2">Bonjour, {{ auth()->user()->name ?? 'Admin' }} 👋</h1>
            <p class="text-muted">Voici ce qui se passe sur votre portfolio aujourd'hui.</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="glass-card px-4 py-2 rounded-4">
                <i class="bi bi-calendar3 me-2"></i>
                {{ now()->format('d/m/Y') }}
            </div>

            <!-- Menu déroulant utilisateur -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary rounded-4 px-3 py-2 d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5"></i>
                    <span>{{ strtoupper(explode(' ', trim(auth()->user()->name ?? ''))[0] ?? 'Admin') }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-pencil-square me-2"></i>Modifier mon profil
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Cartes métriques avec compteurs animés -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="metric-card" data-count="{{ $projectsCount }}">
                <div class="metric-icon bg-primary-soft">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-number counter">0</h3>
                    <p class="metric-label">Projets</p>
                </div>
                <div class="metric-trend text-success">
                    <i class="bi bi-arrow-up-short"></i> +12%
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="metric-card" data-count="{{ $servicesCount }}">
                <div class="metric-icon bg-success-soft">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-number counter">0</h3>
                    <p class="metric-label">Services</p>
                </div>
                <div class="metric-trend text-success">
                    <i class="bi bi-arrow-up-short"></i> +5%
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="metric-card" data-count="{{ $testimonialsCount }}">
                <div class="metric-icon bg-warning-soft">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-number counter">0</h3>
                    <p class="metric-label">Témoignages</p>
                </div>
                <div class="metric-trend text-warning">
                    <i class="bi bi-dash-circle"></i> Stable
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="metric-card" data-count="{{ $messagesCount }}">
                <div class="metric-icon bg-info-soft">
                    <i class="bi bi-envelope-paper"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-number counter">0</h3>
                    <p class="metric-label">Messages</p>
                </div>
                <div class="metric-trend text-info">
                    <i class="bi bi-envelope-exclamation"></i> Non lus
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique + répartition -->
    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="glass-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Activité récente</h5>
                    <select class="form-select form-select-sm w-auto" id="chartPeriod">
                        <option value="7">7 derniers jours</option>
                        <option value="30" selected>30 derniers jours</option>
                    </select>
                </div>
                <canvas id="activityChart" height="250"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-card p-4 h-100">
                <h5 class="mb-3"><i class="bi bi-pie-chart me-2"></i>Répartition</h5>
                <canvas id="repartitionChart" height="200"></canvas>
                <div class="mt-3 text-center small text-muted">
                    Contenu total : {{ $projectsCount + $servicesCount + $testimonialsCount + $messagesCount }}
                </div>
            </div>
        </div>
    </div>

    <!-- Tableaux récents -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="glass-card p-0 overflow-hidden">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Derniers projets</h5>
                    <a href="{{ route('project.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Voir tout <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestProjects as $project)
                            <tr>
                                <td class="fw-semibold">{{ $project->title }}</td>
                                <td>{{ $project->created_at->format('d/m/Y') }}</td>
                                <td><span class="badge bg-success-subtle text-success rounded-pill">Publié</span></td>
                                <td><a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-link text-primary"><i class="bi bi-pencil-square"></i></a></td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted">Aucun projet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="glass-card p-0 overflow-hidden">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center p-4">
                    <h5 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Derniers messages</h5>
                    <a href="{{ route('contact.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Voir tout <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($latestMessages as $message)
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-person-circle me-2 text-muted"></i>
                            <strong>{{ $message->name }}</strong>
                            <div class="small text-muted">{{ $message->email }}</div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-dark rounded-pill">{{ $message->created_at->diffForHumans() }}</span>
                            <a href="{{ route('contact.index') }}" class="btn btn-sm btn-link text-info"><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item bg-transparent text-center">Aucun message</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Footer statut système -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="glass-card py-3 px-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div><i class="bi bi-database"></i> <span class="text-muted">Dernière synchro : {{ now()->format('H:i:s') }}</span></div>
                    <div><span class="badge bg-success"><i class="bi bi-check-circle-fill"></i> Système opérationnel</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques et compteurs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Animation des compteurs
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounter = (counter) => {
        const target = +counter.closest('.metric-card').getAttribute('data-count');
        let count = 0;
        const updateCount = () => {
            const increment = target / speed;
            if (count < target) {
                count = Math.ceil(count + increment);
                counter.innerText = count;
                setTimeout(updateCount, 20);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.counter');
                if (counter && counter.innerText === '0') animateCounter(counter);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.metric-card').forEach(card => observer.observe(card));

    // --- Graphique d'activité dynamique ---
    const ctx = document.getElementById('activityChart').getContext('2d');
    let activityChart;

    // Fonction pour générer des données simulées (ou réelles via AJAX)
    function generateData(days) {
        const labels = [];
        const data = [];

        // Simule des valeurs entre 50 et 500 selon la période
        for (let i = days; i > 0; i--) {
            labels.push(`J-${i}`);
            // Tendance : plus c'est récent, plus c'est élevé (effet de croissance)
            let value = 50 + (days - i) * (400 / days) + Math.random() * 80;
            data.push(Math.floor(value));
        }
        // Inverser pour avoir l'ordre chronologique (plus ancien à gauche)
        return { labels: labels.reverse(), data: data.reverse() };
    }

    function updateChart(days) {
        const { labels, data } = generateData(days);
        if (activityChart) {
            activityChart.data.labels = labels;
            activityChart.data.datasets[0].data = data;
            activityChart.update();
        } else {
            activityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visites / actions',
                        data: data,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.05)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#3b82f6'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { position: 'top' } }
                }
            });
        }
    }

    // Initialisation avec 30 jours
    updateChart(30);

    // Écouteur sur le select
    const periodSelect = document.getElementById('chartPeriod');
    periodSelect.addEventListener('change', function () {
        const days = parseInt(this.value);
        updateChart(days);
    });

    // --- Graphique de répartition (données réelles) ---
    const repCtx = document.getElementById('repartitionChart').getContext('2d');
    new Chart(repCtx, {
        type: 'doughnut',
        data: {
            labels: ['Projets', 'Services', 'Témoignages', 'Messages'],
            datasets: [{
                data: [{{ $projectsCount }}, {{ $servicesCount }}, {{ $testimonialsCount }}, {{ $messagesCount }}],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#06b6d4'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, cutout: '60%', plugins: { legend: { position: 'bottom' } } }
    });
});

</script>

@endsection
