<?php

// app/Http/Controllers/RecipeController.php
namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Services\RecipeService;

class RecipeController extends Controller
{
    protected RecipeService $service;

    public function __construct(RecipeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $recipes = $this->service->getAll();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients_raw' => 'required|string',
            'instructions_raw' => 'required|string',
            'metadata' => 'nullable|array',
            'status' => 'in:favorite,to_try,made_before',
            'user_id' => 'nullable|exists:users,id'
            
        ]);
    
        $data['ingredients'] = array_filter(array_map('trim', explode("\n", $data['ingredients_raw'])));
        $data['instructions'] = array_filter(array_map('trim', explode("\n", $data['instructions_raw'])));
        unset($data['ingredients_raw'], $data['instructions_raw']);
        $data['user_id'] = auth()->id();

        if (!$data['user_id']) {
            return redirect()->route('login')->withErrors(['msg' => 'You must be logged in to add a recipe.']);
        }
        $this->service->create($data);
        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }
    

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'ingredients_raw' => 'nullable|string',
            'instructions_raw' => 'nullable|string',
            'metadata' => 'nullable|array',
            'status' => 'in:favorite,to_try,made_before'
        ]);
    
        if (isset($data['ingredients_raw'])) {
            $data['ingredients'] = array_filter(array_map('trim', explode("\n", $data['ingredients_raw'])));
            unset($data['ingredients_raw']);
        }
    
        if (isset($data['instructions_raw'])) {
            $data['instructions'] = array_filter(array_map('trim', explode("\n", $data['instructions_raw'])));
            unset($data['instructions_raw']);
        }
    
        $this->service->update($recipe, $data);
        return redirect()->route('recipes.index')->with('success', 'Recipe updated!');
    }
    

    public function destroy(Recipe $recipe)
    {
        $this->service->delete($recipe);
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted!');
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $recipes = $this->service->search($q);
        return view('recipes.index', compact('recipes'));
    }

    public function changeStatus(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'status' => 'required|in:favorite,to_try,made_before'
        ]);

        $this->service->changeStatus($recipe, $data['status']);
        return redirect()->back()->with('success', 'Status updated!');
    }
}
