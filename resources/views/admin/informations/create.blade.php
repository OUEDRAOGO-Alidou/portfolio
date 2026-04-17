@extends('layouts.layout')
@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Ajouter mes informations</h1>

    <form action="{{ route('information.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom complet</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Site web</label>
            <input type="url" name="site" class="form-control" value="{{ old('site') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="mb-3">
            <label>Ville</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
        </div>

        <div class="mb-3">
            <label>Date de naissance</label>
            <input type="date" name="dateNaiss" class="form-control" value="{{ old('dateNaiss') }}" required>
        </div>

        <div class="mb-3">
            <label>Diplôme</label>
            <input type="text" name="diplome" class="form-control" value="{{ old('diplome') }}" required>
        </div>

        <div class="mb-3">
            <label>Freelance</label>
            <select name="freelance" class="form-control">
                <option value="disponible">Disponible</option>
                <option value="indisponible">Indisponible</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
