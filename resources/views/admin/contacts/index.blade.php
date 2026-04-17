{{-- resources/views/admin/contacts/index.blade.php --}}
@extends('layouts.layout')
@include('layouts.sidebar')

@section('content')

<style>

body {
    background: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container {
    padding: 30px;
}

.title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table th {
    background: #1f2937;
    color: white;
}

.table tr:nth-child(even) {
    background: #f9fafb;
}

.table tr:hover {
    background: #eef2ff;
}

.badge {
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: bold;
}

.badge-new {
    background: #fef3c7;
    color: #92400e;
}

.actions {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-size: 13px;
}

.btn-view { background: #3b82f6; }
.btn-delete { background: #ef4444; }

.btn:hover {
    opacity: 0.8;
}

.empty {
    text-align: center;
    padding: 40px;
    color: #6b7280;
}

</style>

<div class="container">

    <div class="title">📩 Messages reçus</div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ Str::limit($contact->message, 40) }}</td>
                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="actions">
                            <a href="mailto:{{ $contact->email }}" class="btn btn-view">Répondre</a>

                            <form action="{{ route('contact.destroy', $contact) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete" onclick="return confirm('Supprimer ?')">Suppr</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty">Aucun message reçu</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
