<?php

// app/Repositories/RecipeRepository.php

namespace App\Repositories;

use App\Models\Recipe;

class RecipeRepository
{
    public function getAll()
    {
        return Recipe::where('user_id', auth()->id())->get();
    }

    public function create(array $data)
    {
        return Recipe::create($data);
    }

    public function update(Recipe $recipe, array $data)
    {
        $recipe->update($data);
        return $recipe;
    }

    public function delete(Recipe $recipe)
    {
        return $recipe->delete();
    }

    public function find(int $id): Recipe
    {
        return Recipe::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    public function search(string $query)
    {
        return Recipe::where('user_id', auth()->id())
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                  ->orWhereJsonContains('ingredients', $query)
                  ->orWhereJsonContains('instructions', $query)
                  ->orWhere('metadata->cuisine_type', 'like', "%$query%");
            })
            ->get();
    }

    public function changeStatus(Recipe $recipe, string $status): Recipe
    {
        $recipe->update(['status' => $status]);
        return $recipe;
    }
}
