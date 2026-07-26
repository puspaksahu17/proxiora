@extends('layouts.dashboard')
@section('title', 'Subadmin dashboard')
@section('content')
    <h1>My assigned students</h1><p class="lead">Students assigned to you by the administrator.</p>
    <div class="card" style="margin-bottom:24px"><div class="stat">{{ $students->count() }}</div><p>Assigned students</p></div>
    <table><thead><tr><th>Name</th><th>Email</th><th>Mobile</th><th>Work status</th><th>Progress</th></tr></thead><tbody>@forelse($students as $student)<tr><td>{{ $student->name }}</td><td>{{ $student->email }}</td><td>{{ $student->mobile }}</td><td>{{ ucfirst($student->work_status) }}</td><td>{{ $student->progress }}%</td></tr>@empty<tr><td colspan="5">No students are assigned to you yet.</td></tr>@endforelse</tbody></table>
@endsection
