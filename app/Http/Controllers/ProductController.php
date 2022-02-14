<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductsTags;
use App\Models\Tag;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{


    public function desboard()
    {
        $products = Product::products();

        return view('dashboard', compact('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::products();

        return view('dashboard', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $tags = Tag::all();

        return view('components.product-create', [
            "tags" => $tags
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $product = Product::where('name', $request->name)->get();

        if ($product->count() > 0){
            return redirect()->back()->with('error', 'Whoops já exite esse produto');
        }

        $createProduct = Product::create($request->all());
        $createProduct->save();
        $product_id = $createProduct->id;

        $tags = new ProductsTags();
        $tags->product_id = $product_id;
        $tags->tag_id = $request['tom-select'];
        $tags->save();

         return redirect()->route('product.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
       $product = Product::find($id);

       return view('components.product-edit',);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('components.product-edit',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
