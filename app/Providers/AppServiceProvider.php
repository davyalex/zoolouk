<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SubCategory;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $category = Category::with(['products','media','subcategories'])
        ->whereType('principale')
        ->orderBy('name', 'ASC')->get();

        $subcategory = SubCategory::with(['products','media','category'])->orderBy('name', 'ASC')->get();

        $section_categories = Category::with(['products','media','subcategories'])->orderBy('created_at', 'DESC')
        ->whereType('section')
        ->get();
        
        $roles = Role::get();



        View::composer('*', function($view) use($category, $subcategory,$section_categories,$roles) {
            $view->with([
                'categories' => $category,
                'subcategories' => $subcategory,
                'section_categories' =>$section_categories,
                'roles' => $roles,

        ]);
        });
        
      
    }
}
