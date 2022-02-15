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
     * @return \Illuminate\Http\RedirectResponse
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
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id): View|Factory|Application
    {
        $tagEdit = Tag::find($id);

        return view('components.tag-edit', [
            'tagEdit' => $tagEdit
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tagUpdate = Tag::where('name', $request->name)->get();

        if ($tagUpdate === $request['name']){
            return redirect()->back()->with('error', 'A tag não foi modificada');
        }


        if ($tagUpdate->count() > 0 ){
            return redirect()->back()->with('error', 'A tag já existe');
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
