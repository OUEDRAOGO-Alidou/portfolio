{{-- resources/views/layouts/sidebar.blade.php --}}
<style>
    /* ---------- SIDEBAR STYLE (même univers graphique) ---------- */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 280px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-right: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
        padding: 2rem 1.5rem;
        transition: all 0.3s ease;
        z-index: 1000;
        overflow-y: auto;
    }

    /* Titre du sidebar */
    .sidebar h3 {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 2rem;
        text-align: center;
        letter-spacing: -0.5px;
        position: relative;
    }


    /* Navigation */
    .sidebar nav {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    /* Liens */
    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        color: #4b5563;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.95rem;
    }

    /* Icônes (Bootstrap Icons ou SVG de fallback) */
    .nav-link i, .nav-link svg {
        font-size: 1.25rem;
        width: 1.25rem;
        text-align: center;
        transition: transform 0.2s;
    }

    /* Effet hover */
    .nav-link:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        transform: translateX(5px);
    }

    .nav-link:hover i, .nav-link:hover svg {
        transform: scale(1.1);
    }

    /* Lien actif */
    .nav-link.active {
        background: linear-gradient(90deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
    }

    .nav-link.active i, .nav-link.active svg {
        color: white;
    }

    /* Version responsive : sidebar rétractable sur mobile */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            width: 260px;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        /* Bouton hamburger (à ajouter dans le layout principal) */
        .menu-toggle {
            display: block;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1100;
            background: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            cursor: pointer;
        }
    }

    /* Scrollbar personnalisée */
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }
    .sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 5px;
    }
    .sidebar::-webkit-scrollbar-thumb {
        background: #c7d2fe;
        border-radius: 5px;
    }

</style>

<div class="sidebar" id="adminSidebar">
    <h3 class="text-start">⚡{{ strtoupper(explode(' ', trim(auth()->user()->name ?? ''))[0] ?? 'Admin') }} </h3>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('project.index') }}" class="nav-link {{ request()->routeIs('project.*') ? 'active' : '' }}">
            <i class="bi bi-folder"></i> Projets
        </a>
        <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">
            <i class="bi bi-envelope-paper-heart"></i> Messages
        </a>
        <a href="{{ route('information.index') }}" class="nav-link {{ request()->routeIs('information.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Informations
        </a>
        <a href="{{ route('formations.index') }}" class="nav-link {{ request()->routeIs('formations.*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Formations
        </a>
        <a href="{{ route('experiences.index') }}" class="nav-link {{ request()->routeIs('experiences.*') ? 'active' : '' }}">
            <i class="bi bi-laptop"></i> Experiences
        </a>
        <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Services
        </a>
        <a href="{{ route('skills.index') }}" class="nav-link {{ request()->routeIs('skills.*') ? 'active' : '' }}">
            <i class="bi bi-code-slash"></i> Compétences
        </a>
        <a href="{{ route('stats.index') }}" class="nav-link {{ request()->routeIs('stats.*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Performances
        </a>
        <a href="{{ route('testimonials.index') }}" class="nav-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
             <i class="bi bi-chat-dots"></i> Témoignages
        </a>
        <a href="{{ route('social.index') }}" class="nav-link {{ request()->routeIs('social.*') ? 'active' : '' }}">
            <i class="bi bi-link-45deg"></i> SocialLinks
        </a>
        <a href="{{ route('images.index') }}" class="nav-link {{ request()->routeIs('images.*') ? 'active' : '' }}">
            <i class="bi bi-card-image"></i> Images
        </a>

         <form action="{{ route('logout') }}" method="POST" class="d-inline" class="mt-5">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger rounded-4 px-4 py-2">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </button>
                </form>
        <!-- Ajoutez d'autres liens ici -->
    </nav>
</div>

<!-- Option : bouton hamburger pour mobile (à placer dans votre layout principal) -->
@push('scripts')
<script>
    // Script simple pour toggle sidebar sur mobile (si vous ajoutez le bouton)
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.querySelector('.menu-toggle');
        const sidebar = document.getElementById('adminSidebar');
        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }
    });
</script>
@endpush
