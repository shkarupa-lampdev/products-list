<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Index page with table for products stored in db.
     *
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::paginate(5);

        return view('dashboard', ['products' => $products]);
    }
}
