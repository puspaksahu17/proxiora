@extends('layouts.dashboard')
@section('title', 'My progress')
@section('content')
    <h1>My career progress</h1><p class="lead">Follow your progress through each career milestone.</p>
    <div class="card"><div style="display:flex;justify-content:space-between;align-items:baseline"><strong>Current progress</strong><span class="stat">{{ auth()->user()->progress }}%</span></div><div style="height:12px;margin:18px 0 26px;background:#e7edf8;border-radius:999px;overflow:hidden"><div style="height:100%;width:{{ auth()->user()->progress }}%;background:#2563eb;border-radius:inherit"></div></div>
        @foreach ($milestones as $percentage => $milestone)
            <div style="display:flex;gap:14px;align-items:center;padding:13px 0;border-top:1px solid #edf0f5"><span style="display:grid;place-items:center;flex:0 0 28px;width:28px;height:28px;color:{{ auth()->user()->progress >= $percentage ? '#fff' : '#667085' }};background:{{ auth()->user()->progress >= $percentage ? '#2563eb' : '#eef2f6' }};border-radius:50%;font-size:.75rem">{{ auth()->user()->progress >= $percentage ? '✓' : $percentage.'%' }}</span><span>{{ $milestone }}</span></div>
        @endforeach
    </div>
@endsection
