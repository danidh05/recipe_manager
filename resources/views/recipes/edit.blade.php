@extends('layouts.app')

@section('content')
<h2 class="mb-4">Edit Recipe</h2>

<form method="POST" action="{{ route('recipes.update', $recipe) }}">
    @csrf
    @method('PUT')
    @include('recipes.form', ['recipe' => $recipe])
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
