<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $tags  = DB::table('tags')
            ->join('products_tags', 'tags.id', '=', 'products_tags.tag_id')
            ->join('products', 'products_tags.product_id', '=', 'products.id')
            ->select('tags.*', 'products.name AS product', DB::raw('COALESCE(count(products.name) 0) as qtn_product'))
            ->groupBy('tags.name')
            ->get();

        return view('components.tag', [
            'tags' => $tags
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('components.tag-create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $tagCreate = Tag::where('name', $request->name)->get();

        if ($tagCreate->count() > 0) {
            return redirect()->back()->with('error', 'Whoops já existe essa tag');
        }

        $tagCreate = Tag::create($request->all());
        $tagCreate->save();

        return redirect()->route('tag.index');
    }

    /**
     * @param $id
     * @return void
     */
    public function show($id): void
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $tagEdit = Tag::find($id);

        return view('components.tag-edit', [
            'tagEdit' => $tagEdit
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $tagUpdates = Tag::where('name', $request->name)->where('id', '!=', $id)->get();


        if ($tagUpdates->count() > 0) {
            return redirect()->back()->with('error', 'A tag já existe');
        }

        $tagUpdates = Tag::where('id', $id)->first();
        $tagUpdates->name = $request->name;
        $tagUpdates->save();

        return redirect()->route('tag.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {

        $tagDelete = Tag::findOrFail($id);
        $tagDelete->product()->detach();
        $tagDelete->delete();

        return redirect()->route('tag.index')->with('info', "A tag {$tagDelete->name} foi deletada");
    }
}
