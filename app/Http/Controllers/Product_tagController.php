<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_tag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Product_tagController extends Controller
{
    public function index(Request $request)
    {
        $query = Product_tag::select('product_tag.*', 'products.name as product_name' , 'tags.name as tag_name')
            ->join('products', 'product_tag.product_id', '=', 'products.id')
            ->join('tags', 'product_tag.tag_id', '=', 'tags.id');
        $limit = $request->limit ? $request->limit : 2;
        if (isset($request->s)) {
            $query->where('name', 'like', "%$request->s%");
        }

        $items = $query->paginate($limit);
        $params = [
            'items' => $items,
        ];
        return view("product_tag.index", $params);
    }
    public function create()
    {
        $product_tag = Product_tag::get();
        $products = Product::get();
        $tags = Tag::get();
        $params = [
            'products' => $products,
            'tags' => $tags,
            'product_tag' => $product_tag

        ];

        return view('product_tag.create', $params);
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $item = new Product_tag();
            $item->product_id  = $request->product_id;
            $item->tag_id  = $request->tag_id;
            $item->save();
            Log::info('Product_tag store successfully. ID: ' . $item->id);
            return redirect()->route('product_tag.index')->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('product_tag.index')->with('error', __('sys.store_item_error'));
        }
    }
    public function edit($id)
    {
        try {
            $products = Product::get();
            $tags = Tag::get();
            $product_tag = Product_tag::findOrFail($id);

            $params = [
                'tags' => $tags ,
                'products' => $products ,
                'product_tag' => $product_tag
            ];
            return view("product_tag.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('product_tag.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $item = Product_tag::findOrFail($id);
            $item->product_id  = $request->product_id;
            $item->tag_id  = $request->tag_id;
            $item->save();
            Log::info('Product_tag updated', ['id' => $item->id]);
            return redirect()->route('product_tag.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('product_tag.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('product_tag.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Product_tag::findOrFail($id);
            $item->delete();
            Log::info('Product_tag message', ['context' => 'value']);
            return redirect()->route('product_tag.index')->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('product_tag.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('product_tag.index')->with('error', __('sys.destroy_item_error'));
        }
    }
}
