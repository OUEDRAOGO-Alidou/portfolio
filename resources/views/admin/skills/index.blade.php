@extends('layouts.layout')

@section('title', 'Gestion des compétences')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Compétences</h1>
        <a href="{{ route('skills.create') }}" class="btn btn-primary">+ Nouvelle compétence</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ordre</th>
                        <th>Nom</th>
                        <th>Pourcentage</th>
                        <th>Icône</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr>
                            <td>{{ $skill->order }}</td>
                            <td>{{ $skill->name }}</td>
                            <td>
                                <div class="progress" style="width: 150px;">
                                    <div class="progress-bar" style="width: {{ $skill->percentage }}%;">{{ $skill->percentage }}%</div>
                                </div>
                            </td>
                            <td>
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }}"></i> {{ $skill->icon }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if($skill->is_active)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('skills.edit', $skill) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('skills.destroy', $skill) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette compétence ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucune compétence enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
