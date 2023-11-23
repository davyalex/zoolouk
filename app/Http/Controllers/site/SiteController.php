<?php

namespace App\Http\Controllers\site;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{

    /************Home page */
    public function home()
    {
        //category list
        $category = Category::with('media')->get();

        //collection List
        $collection = Collection::with('media')->get();

        //slider type==banniere
        $slider_banniere = Slider::whereType('banniere')->orderBy('created_at', 'DESC')->get();


        //category with product
        $category_with_product = Category::withWhereHas('products', fn ($q) =>
        $q->with('media'))->orderBy('type', 'DESC')->get();

        return view('site.home', compact('category', 'category_with_product', 'collection', 'slider_banniere'));
    }


    /*********Get List category */

    public function categoryList()
    {

        $category = Category::with('media')->orderBy('name', 'ASC')->get();

        return view('site.pages.category-list', compact('category'));
    }


    /*********Get Sub category of category choice */

    public function subCategoryList()
    {
        $category = request('c');
        // dd($category);

        $subcategory = SubCategory::with('media')
            ->where('category_id', $category)
            ->orderBy('name', 'ASC')->get();

        //show title page
        $title = Category::whereId($subcategory[0]['category_id'])->first();
        return view('site.pages.subcategory-list', compact('subcategory', 'title'));
    }

    /**********Get detail of product */
    public function product_detail(string $id)
    {
        $product = Product::whereId($id)
            ->with(['categories', 'collection', 'tailles', 'pointures', 'media'])
            ->firstOrFail();

        return view('site.pages.product-detail', compact('product'));
    }

    /********** Get shop List of category  */
    public function shop(Request $request)
    {
        $category = request('category');
        $subcategory = request('subcategory');
        if ($category) {

            $product = Product::whereHas(
                'categories',
                fn ($q) => $q->where('category_product.category_id', $category),

            )->with(['collection', 'media', 'categories'])
                ->get();

            $category = Category::whereId($category)->with('media')->first();

            //show title page
            $title =   $category = Category::whereId($category['id'])->with('media')->first();
            $title_name =  $title['name'];
        } else if ($subcategory) {

            $product = Product::with(['collection', 'media', 'categories'])
                ->where('sub_category_id', $subcategory)->get();

            $category = Category::whereId($category)->with('media')->first();

            //show title page
            $title = SubCategory::whereId($subcategory)->first();
            $title_name =  $title['name'];
        } else {
            $product = Product::all();
            $title_name = 'Boutique';
            $title =   $category = Category::with('media')->get()->random(1);

        }

        return view('site.pages.shop', compact('product', 'category', 'title', 'title_name'));
    }


    /***************Search product */

    public function searchProduct(Request $request)
    {
        $search = $request['search'];
        $product = Product::with(['categories', 'subcategorie', 'media'])
            ->where('title', 'Like', "%{$search}%")
            ->orderBy('created_at', 'desc')->get();
        $title = $search;
        return view('site.pages.shop', compact('product', 'title'));
    }
}
