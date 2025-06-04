# 🍳 Recipe Management System with AI Feature

## 🧠 Project Overview

This is a **multi-user Recipe Management System** built with **Laravel 11**, implementing **Breeze (Blade UI)** for authentication, **repository-service-controller** architecture for maintainability, and integrated **OpenAI GPT-3.5-turbo** for recipe suggestions based on user prompts.

---

## ✅ Features Implemented

### 🧾 Core Features

-   **CRUD for Recipes**  
    Each recipe has:

    -   Name
    -   Ingredients (multi-line input)
    -   Instructions (multi-line input)
    -   Metadata (JSON: e.g. `prep_time`, `cuisine_type`)
    -   Status tag: `favorite`, `to_try`, `made_before`

-   **Search Functionality**

    -   Search by name, ingredients, instructions, or cuisine type.

-   **Status Tagging**
    -   Change status of any recipe to one of the 3 preset options.

### 👥 Multi-User System

-   **Breeze Authentication** (register, login, password reset)
-   Each user only sees their **own recipes** (via `user_id` foreign key).
-   Routes and views are protected using the `auth` middleware.
-   User-recipe relationship is enforced at both Eloquent and query level.

### 🧠 AI Recipe Suggestion Feature

-   Uses **OpenAI API (gpt-3.5-turbo)**.
-   User enters a description (e.g., "Quick dinner with chicken and rice") and receives:
    -   Generated recipe name
    -   Ingredients
    -   Instructions
    -   Metadata (`cuisine_type`, `prep_time`)

---

## 🛠 Technical Architecture

### 🧩 Design Patterns

-   **Repository Pattern** – for abstracting data layer
-   **Service Layer** – for business logic
-   **Controller Layer** – minimal and focused on request flow

### 💾 Database

-   Laravel migrations were used to:
    -   Add `user_id` to `recipes` table
    -   Enforce foreign key constraints
    -   Enable multi-user support

### 🌐 Frontend (Blade)

-   Used Laravel Breeze Blade UI with:
    -   Tailwind CSS (default with Breeze)
    -   Dynamic and responsive layout
    -   Navigation bar with links to all features

---

## 🧪 Testing & Fixes

### ❗Notable Issues & Resolutions

| Issue                                      | Solution                                                                            |
| ------------------------------------------ | ----------------------------------------------------------------------------------- |
| `SQLSTATE[42S22] user_id column not found` | Ran `php artisan migrate:fresh` to apply schema changes                             |
| `user_id` was null on recipe creation      | Checked auth status, redirected unauthenticated users to login                      |
| Bootstrap not applying                     | Breeze uses Tailwind by default; Bootstrap was skipped                              |
| `cURL error 60` (SSL cert issue)           | Disabled SSL verification temporarily with `Http::withOptions(['verify' => false])` |
| Undefined `$slot` in layout                | Replaced with `@yield('content')` and added proper `@section()` usage               |
| Navigation missing routes                  | Added links to recipe pages, AI suggestions, and search in layout navigation        |

---

## 🚀 How to Run

1. Clone the project and `cd` into it
2. Set up `.env` and configure your MySQL database
3. Run the following commands:
    ```bash
    composer install
    php artisan migrate --seed
    npm install && npm run dev
    php artisan serve
    Add your OpenAI key in .env:
    ```

ini
Copy
Edit
OPENAI_API_KEY=your_key_here
🔮 Planned but Not Implemented (Yet)
These features were considered but not implemented due to limited time:

🛡️ Authorization Policies (e.g., recipe ownership checks with Laravel policies)

📷 Image Upload (e.g., attach images to recipes using local or S3 storage)

📊 Analytics Dashboard (e.g., most cooked recipes, frequent tags, etc.)

🧠 AI Meal Planner (suggest full weekly meal plans based on diet type)

📁 Export to PDF (generate and download printable versions of recipes)

💬 Comments & Ratings (allow user feedback per recipe)

🔍 Advanced Filtering (e.g., by cuisine type, prep time, or ingredient count)
