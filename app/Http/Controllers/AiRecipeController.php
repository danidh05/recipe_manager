<?php

// app/Http/Controllers/AiRecipeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiRecipeController extends Controller
{
    public function showForm()
    {
        return view('ai.form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|string',
        ]);

        $ingredients = $request->input('ingredients');

        $prompt = "Generate a recipe using the following ingredients: $ingredients. Provide the name, a short list of ingredients, and clear cooking instructions.";

        $response = Http::withOptions([
            'verify' => false, // disables SSL cert check (TEMPORARY FIX)
        ])->withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ]);
        

        $result = $response->json('choices.0.message.content');

        return view('ai.result', compact('result', 'ingredients'));
    }
}
