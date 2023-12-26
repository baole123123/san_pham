<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id');
        $limit = $request->limit ? $request->limit : 2;
        if (isset($request->s)) {
            $query->where('name', 'like', "%$request->s%");
        }

        $items = $query->paginate($limit);
        $params = [
            'items' => $items,
        ];
        return view("products.index", $params);
    }
    public function create()
    {
        $products = Product::get();
        $categories = Category::get();
        $params = [
            'products' => $products,
            'categories' => $categories
        ];

        return view('products.create', $params);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            // dd($request->all());
            $item = new Product();
            $item->name = $request->name;
            $item->price = $request->price;
            $item->category_id  = $request->category_id;
            $item->status = $request->status;
            $item->save();
            Log::info('Product store successfully. ID: ' . $item->id);
            return redirect()->route('products.index')->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.store_item_error'));
        }
    }

    public function edit($id)
    {
        try {
            $categories = Category::get();
            $item = Product::findOrFail($id);

            $params = [
                'item' => $item ,
                'categories' => $categories
            ];
            return view("products.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $item = Product::findOrFail($id);
            $item->name = $request->name;
            $item->price = $request->price;
            $item->category_id  = $request->category_id;
            $item->status = $request->status;
            $item->save();
            Log::info('Product updated', ['id' => $item->id]);
            return redirect()->route('products.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Product::findOrFail($id);
            $item->delete();
            Log::info('Product message', ['context' => 'value']);
            return redirect()->route('products.index')->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.destroy_item_error'));
        }
    }
}
