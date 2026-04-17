@extends('layouts.layout')

@section('title', 'Gestion des expériences')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Expériences professionnelles</h1>
        <a href="{{ route('experiences.create') }}" class="btn btn-primary">+ Nouvelle expérience</a>
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
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($experiences as $exp)
                        <tr>
                            <td>{{ $exp->order }}</td>
                            <td>{{ $exp->titre }}</td>
                            <td>{{ Str::limit($exp->description, 80) }}</td>
                            <td>
                                <a href="{{ route('experiences.edit', $exp) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('experiences.destroy', $exp) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Aucune expérience</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
