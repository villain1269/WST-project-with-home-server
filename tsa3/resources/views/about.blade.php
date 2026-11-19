@extends('layouts.app')

@section('title', 'About — TSA3')

@section('content')
    <h1>About</h1>
    <p>
        This application is the TSA3 summative assessment for IT0049 (Web
        System Technologies): the <em>Tasks for Today Management System</em>,
        built with Laravel.
    </p>
    <p>
        Developed by <strong>Christian Ola</strong>. The system manages a
        personal daily task list: the Welcome page shows only the tasks
        scheduled for today, the Task List page shows every task ordered by
        date, and the Profile page displays the single user record. The
        schema is defined with Laravel migrations, seeded with realistic
        sample data, and queried through Eloquent models.
    </p>
@endsection
