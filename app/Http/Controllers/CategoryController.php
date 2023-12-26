<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Log as SystemLog;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        // $this->authorize('viewAny', Category::class);
        $query = Category::select('*');
        $limit = $request->limit ? $request->limit : 2;
        if (isset($request->s)) {
            $query->where('name', 'like', "%$request->s%");
        }

        $items = $query->paginate($limit);
        $params = [
            'items' => $items,
        ];
        return view("categories.index", $params);
    }
    public function create()
    {
        $items = Category::get();
        return view('categories.create', compact('items'));
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            // dd($request->all());
            $item = new Category();
            $item->name = $request->name;
            $item->status = $request->status;
            $item->save();
            Log::info('Category store successfully. ID: ' . $item->id);
            return redirect()->route('categories.index')->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.store_item_error'));
        }
    }

    public function edit($id)
    {
        try {
            $item = Category::findOrFail($id);
            $params = [
                'item' => $item
            ];
            return view("categories.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $item = Category::findOrFail($id);
            $item->name = $request->name;
            $item->status = $request->status;
            $item->save();
            Log::info('Category updated', ['id' => $item->id]);
            return redirect()->route('categories.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Category::findOrFail($id);
            $item->delete();
            Log::info('Category message', ['context' => 'value']);
            return redirect()->route('categories.index')->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.destroy_item_error'));
        }
    }
}
