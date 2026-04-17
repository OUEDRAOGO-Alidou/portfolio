@extends('layouts.layout')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Modifier la section "À propos"</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire de mise à jour (PUT) avec un ID --}}
    <form id="updateForm" action="{{ route('admin.about.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Texte Profile </label>
            <textarea name="profile_text" id="profile_text" class="form-control summernote">{{ old('profile_text', $info['profile_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte d'introduction (sous À propos)</label>
            <textarea name="intro_text" id="intro_text" class="form-control summernote">{{ old('intro_text', $info['intro_text']) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Titre du poste</label>
            <input type="text" name="job_title" class="form-control" value="{{ old('job_title', $info['job_title']) }}">
        </div>

        <div class="mb-3">
            <label>Texte d'introduction (sous le titre du poste)</label>
            <textarea name="intro_title" id="intro_title" class="form-control summernote">{{ old('intro_title', $info['intro_title']) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Texte Expertise/Compétence</label>
            <textarea name="expertise_text" id="expertise_text" class="form-control summernote">{{ old('expertise_text', $info['expertise_text']) }}</textarea>
        </div>

        <div class="mb-3">
            <label> Texte Performance</label>
            <textarea name="performance_text" id="performance_text" class="form-control summernote">{{ old('performance_text', $info['performance_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte Compétence</label>
            <textarea name="competence_text" id="competence_text" class="form-control summernote">{{ old('competence_text', $info['competence_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte Parcours</label>
            <textarea name="parcour_text" id="parcour_text" class="form-control summernote">{{ old('parcour_text', $info['parcour_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte Realisation</label>
            <textarea name="realisation_text" id="realisation_text" class="form-control summernote">{{ old('realisation_text', $info['realisation_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte Service</label>
            <textarea name="service_text" id="service_text" class="form-control summernote">{{ old('service_text', $info['service_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte Témoignage</label>
            <textarea name="temoin_text" id="temoin_text" class="form-control summernote">{{ old('temoin_text', $info['temoin_text']) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Texte Contact</label>
            <textarea name="contact_text" id="contact_text" class="form-control summernote">{{ old('contact_text', $info['contact_text']) }}</textarea>
        </div>
    </form>

    {{-- Conteneur flex pour les deux boutons --}}
    <div class="d-flex gap-2 mt-3">
        <button type="submit" form="updateForm" class="btn btn-primary">Enregistrer</button>

        <form action="{{ route('admin.about.reset') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Réinitialiser toutes les informations ?')">Réinitialiser</button>
        </form>
    </div>
</div>

<!-- Summernote CDN -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 125,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']]
            ]
        });
    });
</script>
@endsection
