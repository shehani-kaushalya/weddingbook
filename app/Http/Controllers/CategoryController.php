<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listAll() {



		}


		public function singleCat($slug) {


    	$cat = ProductCategory::where('slug', $slug)->first();

    	$products = Product::where('category_id', $cat->id)->where('status',100)->get();

    	return view('customer.category.single', compact('cat', 'products'));


		}


}


