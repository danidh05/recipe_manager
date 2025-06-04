@extends('layouts.app')

@section('content')
<h2>{{ $recipe->name }}</h2>
<p>Status: <strong>{{ ucfirst($recipe->status) }}</strong></p>

<h4 class="mt-4">Ingredients</h4>
<ul class="list-group mb-4">
    @foreach ($recipe->ingredients as $item)
        <li class="list-group-item">{{ $item }}</li>
    @endforeach
</ul>

<h4>Instructions</h4>
<ol class="list-group list-group-numbered mb-4">
    @foreach ($recipe->instructions as $step)
        <li class="list-group-item">{{ $step }}</li>
    @endforeach
</ol>

@if($recipe->metadata)
    <p><strong>Cuisine:</strong> {{ $recipe->metadata['cuisine_type'] ?? 'N/A' }}</p>
    <p><strong>Prep Time:</strong> {{ $recipe->metadata['prep_time'] ?? 'N/A' }} minutes</p>
@endif

<a href="{{ route('recipes.index') }}" class="btn btn-secondary">Back</a>
@endsection
