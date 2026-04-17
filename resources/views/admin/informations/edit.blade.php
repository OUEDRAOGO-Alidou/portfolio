@extends('layouts.layout')
@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Modifier mes informations</h1>

    <form action="{{ route('information.update', $information) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom complet</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $information->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Site web</label>
            <input type="url" name="site" class="form-control" value="{{ old('site', $information->site) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $information->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $information->phone) }}" required>
        </div>

        <div class="mb-3">
            <label>Ville</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $information->city) }}" required>
        </div>

        <div class="mb-3">
            <label>Date de naissance</label>
            <input type="date" name="dateNaiss" class="form-control" value="{{ old('dateNaiss', $information->dateNaiss ? \Carbon\Carbon::parse($information->dateNaiss)->format('Y-m-d') : '') }}" required>
        </div>

        <div class="mb-3">
            <label>Diplôme</label>
            <input type="text" name="diplome" class="form-control" value="{{ old('diplome', $information->diplome) }}" required>
        </div>

        <div class="mb-3">
            <label>Freelance</label>
            <select name="freelance" class="form-control">
                <option value="disponible" {{ $information->freelance == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="indisponible" {{ $information->freelance == 'indisponible' ? 'selected' : '' }}>Indisponible</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
