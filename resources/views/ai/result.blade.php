@extends('layouts.app')

@section('content')
<h2 class="mb-4">🍽️ AI-Generated Recipe</h2>

<div class="mb-3">
    <h5 class="text-muted">Ingredients you entered:</h5>
    <p>{{ $ingredients }}</p>
</div>

<div class="card shadow-sm">
    <div class="card-body" style="white-space: pre-wrap;">
        {!! nl2br(e($result)) !!}
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('ai.form') }}" class="btn btn-secondary">🔁 Try Again</a>
    <a href="{{ route('recipes.create') }}" class="btn btn-success">💾 Save as Recipe</a>
</div>
@endsection
