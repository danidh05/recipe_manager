<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $recipe->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Ingredients (one per line)</label>
    <textarea name="ingredients_raw" class="form-control" rows="4" required>@if(isset($recipe)){{ implode("\n", $recipe->ingredients) }}@endif</textarea>
</div>

<div class="mb-3">
    <label>Instructions (one per line)</label>
    <textarea name="instructions_raw" class="form-control" rows="4" required>@if(isset($recipe)){{ implode("\n", $recipe->instructions) }}@endif</textarea>
</div>

<div class="mb-3">
    <label>Prep Time (minutes)</label>
    <input type="number" name="metadata[prep_time]" class="form-control" value="{{ $recipe->metadata['prep_time'] ?? '' }}">
</div>

<div class="mb-3">
    <label>Cuisine Type</label>
    <input type="text" name="metadata[cuisine_type]" class="form-control" value="{{ $recipe->metadata['cuisine_type'] ?? '' }}">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-select">
        <option value="to_try" {{ (old('status', $recipe->status ?? '') === 'to_try') ? 'selected' : '' }}>To Try</option>
        <option value="favorite" {{ (old('status', $recipe->status ?? '') === 'favorite') ? 'selected' : '' }}>Favorite</option>
        <option value="made_before" {{ (old('status', $recipe->status ?? '') === 'made_before') ? 'selected' : '' }}>Made Before</option>
    </select>
</div>
