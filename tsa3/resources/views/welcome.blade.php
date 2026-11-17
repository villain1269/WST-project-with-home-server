@extends('layouts.app')

@section('title', 'Welcome — TSA3')

@section('content')
    <h1>Welcome — Tasks for Today</h1>
    <p class="lead">Only the tasks scheduled for today, {{ $today }}.</p>

    @if ($tasks->isEmpty())
        <p>No tasks scheduled for today. Enjoy the clear calendar!</p>
    @else
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
    @endif

    <p class="lead">
        <a class="btn" href="{{ route('tasks.index') }}">View Full Task List</a>
    </p>
@endsection
