@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de Tareas</h2>
        </div>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

    @if (Session::get('success'))
        <div class="alert alert-success col-6 mx-auto">{{ Session::get('success') }}</div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach ($tasks as $task)

            <tr>
                <td class="fw-bold">{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    {{ $task->due_date }}
                </td>
                <td>
                    <span class="badge {{ $task->status === 'Done' ? 'bg-success' : ($task->status === 'Doing' ? 'bg-warning' : 'bg-primary') }} fs-6">{{ $task->status }}</span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editar</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $tasks->links() }}
    </div>
</div>
@endsection
