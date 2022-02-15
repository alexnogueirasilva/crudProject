<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $tags = Tag::all();

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

        if ($tagCreate->count() > 0){
            return redirect()->back()->with('error', 'Whoops já existe essa tag');
        }

        $tagCreate = Tag::create($request->all());
        $tagCreate->save();

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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

        $tagUpdates = Tag::where('name', $request->name);

        if ($tagUpdates->count() > 0 ){
            return redirect()->back()->with('error', 'A tag já existe, não foi modificado');
        }

       $tagUpdate = Tag::where('id', $id)->first();
       $tagUpdate->name = $request->name;
       $tagUpdate->save();

       return redirect()->route('tag.index');
    }


    public function destroy($id)
    {
        $tagRelationship = Tag::tagRelationship();

       if ( $tagRelationship->count() > 0){
           return redirect()->back()->with('error', 'A tag não pode ser excluída pois está atrelada a um produto');
       }

       Tag::findOrFail($id)->delete();

       return redirect()->route('tag.index');
    }
}
