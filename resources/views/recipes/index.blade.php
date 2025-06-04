@extends('layouts.app')

@section('content')
<h2 class="mb-4">All Recipes</h2>

<a href="{{ route('recipes.create') }}" class="btn btn-success mb-3">+ Create Recipe</a>

<form method="GET" action="{{ route('recipes.search') }}" class="mb-4">
    <input type="text" name="q" class="form-control" placeholder="Search recipes...">
</form>

@if(count($recipes))
    @foreach ($recipes as $recipe)
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $recipe->name }}</h4>
                <p>Status: <strong>{{ ucfirst($recipe->status) }}</strong></p>
                <div class="mb-2">
                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this recipe?')">Delete</button>
                    </form>
                </div>

                <form action="{{ route('recipes.changeStatus', $recipe) }}" method="POST" class="d-inline">
                    @csrf @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm w-auto d-inline">
                        <option value="to_try" {{ $recipe->status === 'to_try' ? 'selected' : '' }}>To Try</option>
                        <option value="favorite" {{ $recipe->status === 'favorite' ? 'selected' : '' }}>Favorite</option>
                        <option value="made_before" {{ $recipe->status === 'made_before' ? 'selected' : '' }}>Made Before</option>
                    </select>
                </form>
            </div>
        </div>
    @endforeach
@else
    <p>No recipes found.</p>
@endif
@endsection
