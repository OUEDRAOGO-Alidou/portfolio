@extends('layouts.layout')
  {{-- à adapter selon votre layout --}}

  @include('layouts.sidebar')

<style>

</style>
@section('content')
<div class="container">
    <h1>Gérer les liens des réseaux sociaux</h1>

    <form method="POST" action="{{ route('social.store') }}" id="socialForm">
        @csrf
        <div id="links-container">
            @if(old('platforms'))
                {{-- En cas d'erreur de validation, on affiche les champs saisis --}}
                @foreach(old('platforms') as $index => $oldPlatform)
                <div class="link-group">
                    <select name="platforms[]" required>
                        <option value="">Choisir un réseau</option>
                        <option value="facebook" {{ $oldPlatform == 'facebook' ? 'selected' : '' }}>Facebook</option>
                        <option value="twitter" {{ $oldPlatform == 'twitter' ? 'selected' : '' }}>Twitter</option>
                        <option value="linkedin" {{ $oldPlatform == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                        <option value="instagram" {{ $oldPlatform == 'instagram' ? 'selected' : '' }}>Instagram</option>
                        <option value="youtube" {{ $oldPlatform == 'youtube' ? 'selected' : '' }}>YouTube</option>
                        <option value="github" {{ $oldPlatform == 'github' ? 'selected' : '' }}>GitHub</option>
                    </select>
                    <input type="url" name="urls[]" value="{{ old('urls')[$index] ?? '' }}" placeholder="https://..." required>
                    <button type="button" class="remove-link">Supprimer</button>
                </div>
                @endforeach
            @else
                {{-- Affichage des liens existants en base --}}
                @forelse($links as $link)
                <div class="link-group">
                    <select name="platforms[]" required>
                        <option value="">Choisir un réseau</option>
                        <option value="facebook" {{ $link->platform == 'facebook' ? 'selected' : '' }}>Facebook</option>
                        <option value="twitter" {{ $link->platform == 'twitter' ? 'selected' : '' }}>Twitter</option>
                        <option value="linkedin" {{ $link->platform == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                        <option value="instagram" {{ $link->platform == 'instagram' ? 'selected' : '' }}>Instagram</option>
                        <option value="youtube" {{ $link->platform == 'youtube' ? 'selected' : '' }}>YouTube</option>
                        <option value="github" {{ $link->platform == 'github' ? 'selected' : '' }}>GitHub</option>
                    </select>
                    <input type="url" name="urls[]" value="{{ $link->url }}" placeholder="https://..." required>
                    <button type="button" class="remove-link">Supprimer</button>
                </div>
                @empty
                <div class="link-group">
                    <select name="platforms[]" required>
                        <option value="">Choisir un réseau</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="instagram">Instagram</option>
                        <option value="youtube">YouTube</option>
                        <option value="github">GitHub</option>
                    </select>
                    <input type="url" name="urls[]" placeholder="https://..." required>
                    <button type="button" class="remove-link">Supprimer</button>
                </div>
                @endforelse
            @endif
        </div>

        <button type="button" id="add-link">+ Ajouter un lien</button>
        <button type="submit">Enregistrer tous les liens</button>
    </form>

    {{-- Message flash --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
</div>



@endsection
