@extends('layouts.layout') {{-- ou votre layout admin --}}


@section('title', 'Gestion des services')

@include('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Services</h1>
        <a href="{{ route('services.create') }}" class="btn btn-primary">+ Nouveau service</a>
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
                        <th>Icône</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->order }}</td>
                            <td>{{ $service->title }}</td>
                            <td>{{ Str::limit($service->description, 60) }}</td>
                            <td><i class="{{ $service->icon }}"></i> {{ $service->icon }}</td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce service ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun service enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
