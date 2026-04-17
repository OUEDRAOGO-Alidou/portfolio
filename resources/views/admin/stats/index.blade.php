{{-- resources/views/admin/stats/index.blade.php --}}
@extends('layouts.layout')
@section('title', 'Gestion des performances')
@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Performances (statistiques)</h1>
        <a href="{{ route('stats.create') }}" class="btn btn-primary">+ Ajouter</a>
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
                        <th>Icône</th>
                        <th>Titre</th>
                        <th>Valeur</th>
                        <th>Lien</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats as $stat)
                        <tr>
                            <td>{{ $stat->order }}</td>
                            <td><i class="bi {{ $stat->icon }}"></i> {{ $stat->icon }}</td>
                            <td>{{ $stat->title }}</td>
                            <td>{{ $stat->value }}</td>
                            <td>{{ $stat->link ?: '-' }}</td>
                            <td>
                                 @if($stat->is_active )
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('stats.edit', $stat) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('stats.destroy', $stat) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Aucune statistique</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
