@extends('layouts.layout') {{-- Adapte selon ton layout admin --}}

@include('layouts.sidebar')

@section('content')
<div class="container">
    <h1>Gestion des projets</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">+ Nouveau projet</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr><th>Titre</th><th>Catégorie</th><th>Actif</th><th>Ordre</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->categorie }}</td>
                <td>
                    @if($project->is_active)
                        <span class="badge bg-success">Oui</span>
                            @else
                        <span class="badge bg-danger">Non</span>
                    @endif

                </td>
                <td>{{ $project->ordre }}</td>
                <td>
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
