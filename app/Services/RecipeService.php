<?php

// app/Services/RecipeService.php

namespace App\Services;

use App\Models\Recipe;
use App\Repositories\RecipeRepository;

class RecipeService
{
    protected RecipeRepository $repo;

    public function __construct(RecipeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll() { return $this->repo->getAll(); }
    public function create(array $data) { return $this->repo->create($data); }
    public function update(Recipe $recipe, array $data) { return $this->repo->update($recipe, $data); }
    public function delete(Recipe $recipe) { return $this->repo->delete($recipe); }
    public function find(int $id) { return $this->repo->find($id); }
    public function search(string $q) { return $this->repo->search($q); }
    public function changeStatus(Recipe $recipe, string $status) { return $this->repo->changeStatus($recipe, $status); }
}
