{{-- resources/views/admin/profile/edit.blade.php --}}
@extends('layouts.layout')
@section('content')
@include('layouts.sidebar')

<style>
    /* ---------- RESET & BASE ---------- */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        min-height: 100vh;
        padding: 2rem 1rem;
    }

    /* Conteneur principal */
    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Carte glassmorphique */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.3);
    }

    /* Bandeau coloré */
    .hero-bar {
        height: 6px;
        background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
    }

    /* Contenu intérieur */
    .card-content {
        padding: 2rem 2rem 2.5rem;
    }

    /* En-tête avec avatar */
    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .avatar {
        width: 100px;
        height: 100px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: bold;
        color: white;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        border: 4px solid white;
        transition: transform 0.3s;
    }

    .avatar:hover {
        transform: scale(1.05);
    }

    h1 {
        font-size: 2rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.25rem;
    }

    .subtitle {
        color: #6b7280;
        font-size: 0.9rem;
    }

    /* Message flash */
    .alert-success {
        background: linear-gradient(90deg, #d1fae5, #a7f3d0);
        border-left: 5px solid #10b981;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideIn 0.4s ease-out;
    }

    /* Formulaire */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .input-group {
        display: flex;
        flex-direction: column;
    }

    .input-group.full-width {
        grid-column: span 2;
    }

    label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: #374151;
    }

    label svg {
        width: 1.1rem;
        height: 1.1rem;
        fill: none;
        stroke: #667eea;
        stroke-width: 2;
    }

    input, select {
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        font-size: 0.95rem;
        transition: all 0.2s;
        outline: none;
        background: white;
    }

    input:focus, select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    /* Radio group */
    .radio-group {
        display: flex;
        gap: 1.5rem;
        margin-top: 0.5rem;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .radio-option input {
        width: 1.1rem;
        height: 1.1rem;
        accent-color: #667eea;
    }

    /* Bouton */
    .btn-submit {
        background: linear-gradient(90deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 3rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 14px 0 rgba(102, 126, 234, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(102, 126, 234, 0.5);
    }

    /* Animation keyframes */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .input-group.full-width {
            grid-column: span 1;
        }
        .card-content {
            padding: 1.5rem;
        }
    }
</style>

<div class="profile-container">
    <div class="glass-card">
        <div class="hero-bar"></div>
        <div class="card-content">
            <div class="profile-header">
                <div class="avatar">
                    {{ strtoupper(substr(old('name', $information->name ?? 'M'), 0, 1)) }}
                </div>
                <h1>Mon profil</h1>
                <p class="subtitle">Modifiez vos informations personnelles</p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ $information ? route('information.update', $information->id) : route('information.store') }}" method="POST">
                @csrf
                @if($information) @method('PUT') @endif

                <div class="form-grid">
                    <!-- Nom -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Nom complet
                        </label>
                        <input type="text" name="name" value="{{ old('name', $information->name ?? '') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email', $information->email ?? '') }}" required>
                    </div>

                    <!-- Téléphone -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Téléphone
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', $information->phone ?? '') }}">
                    </div>

                    <!-- Ville -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Ville
                        </label>
                        <input type="text" name="city" value="{{ old('city', $information->city ?? '') }}">
                    </div>

                    <!-- Date de naissance -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Date de naissance
                        </label>
                        <input type="date" name="dateNaiss" value="{{ old('dateNaiss', $information->dateNaiss ?? '') }}">
                    </div>

                    <!-- Âge -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Âge
                        </label>
                        <input type="number" name="age" value="{{ old('age', $information->age ?? '') }}">
                    </div>

                    <!-- Diplôme -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            Diplôme
                        </label>
                        <input type="text" name="diplome" value="{{ old('diplome', $information->diplome ?? '') }}">
                    </div>

                    <!-- Site web -->
                    <div class="input-group">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.66 0 3-4 3-9s-1.34-9-3-9m0 18c-1.66 0-3-4-3-9s1.34-9 3-9"/></svg>
                            Site web
                        </label>
                        <input type="text" name="site" value="{{ old('site', $information->site ?? '') }}">
                    </div>

                    <!-- Freelance -->
                    <div class="input-group full-width">
                        <label>
                            <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Statut freelance
                        </label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="freelance" value="1" {{ old('freelance', $information->freelance ?? false) == 1 ? 'checked' : '' }}>
                                <span>✅ Disponible</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="freelance" value="0" {{ old('freelance', $information->freelance ?? false) == 0 ? 'checked' : '' }}>
                                <span>⛔ Indisponible</span>
                            </label>
                            <p> <a href="{{ route('admin.about.edit') }}"> <small>mettre à jours vos données à apropos</small></a> </p>
                        </div>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 2rem;">
                    <button type="submit" class="btn-submit">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        {{ $information ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
