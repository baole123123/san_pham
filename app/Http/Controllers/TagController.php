<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::select('*');
        $limit = $request->limit ? $request->limit : 2;
        if (isset($request->s)) {
            $query->where('name', 'like', "%$request->s%");
        }

        $items = $query->paginate($limit);
        $params = [
            'items' => $items,
        ];
        return view("tags.index", $params);
    }
    public function create()
    {
        $items = Tag::get();
        return view('tags.create', compact('items'));
    }

    public function store(StoreTagRequest $request)
    {
        try {
            // dd($request->all());
            $item = new Tag();
            $item->name = $request->name;
            $item->status = $request->status;
            $item->save();
            Log::info('Tag store successfully. ID: ' . $item->id);
            return redirect()->route('tags.index')->with('success', __('sys.store_item_success'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('tags.index')->with('error', __('sys.store_item_error'));
        }
    }

    public function edit($id)
    {
        try {
            $item = Tag::findOrFail($id);
            $params = [
                'item' => $item
            ];
            return view("tags.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('tags.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(UpdateTagRequest $request, $id)
    {
        try {
            $item = Tag::findOrFail($id);
            $item->name = $request->name;
            $item->status = $request->status;
            $item->save();
            Log::info('Tag updated', ['id' => $item->id]);
            return redirect()->route('tags.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('tags.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('tags.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Tag::findOrFail($id);
            $item->delete();
            Log::info('Log message', ['context' => 'value']);
            return redirect()->route('tags.index')->with('success', __('sys.destroy_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('tags.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('tags.index')->with('error', __('sys.destroy_item_error'));
        }
    }
}
