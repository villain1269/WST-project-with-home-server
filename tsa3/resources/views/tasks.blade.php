@extends('layouts.app')

@section('title', 'Task List — TSA3')

@section('content')
    <h1>Task List</h1>
    <p class="lead">Every task, ordered by date.</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $index => $task)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>
                        <span class="badge {{ $task->status === 'done' ? 'badge-done' : 'badge-pending' }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td>{{ $task->task_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
