@extends('layouts.app')

@section('content')
<h2 class="mb-4">Create New Recipe</h2>

<form method="POST" action="{{ route('recipes.store') }}">
    @csrf
    @include('recipes.form', ['recipe' => null])
    <button class="btn btn-success">Save</button>
    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
