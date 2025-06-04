@extends('layouts.app')

@section('content')
<h2 class="mb-4">🧠 AI Recipe Generator</h2>

<form action="{{ route('ai.generate') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="ingredients" class="form-label">Enter ingredients (comma-separated)</label>
        <textarea name="ingredients" class="form-control" rows="3" required>{{ old('ingredients') }}</textarea>
    </div>
    <button class="btn btn-primary">Generate Recipe</button>
</form>
@endsection
