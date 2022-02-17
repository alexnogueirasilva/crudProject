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


    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        $products = Product::with('tags')->get();

        return view('dashboard', [
            'products' => $products
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::paginate(6);

        return view('components.product', [
            'products' => $products
        ]);
    }

    public function relationship()
    {
        $tags = Tag::all();
        $products = Product::all();

        return view('components.product-relationship', [
            "tags" => $tags,
            "products" => $products
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createRelationship(Request $request): RedirectResponse
    {

        $relationships = Product::products();

        foreach ($relationships as $relationship) {
            if ($relationship->product_id == $request->product_id && $relationship->tag_id == $request->tag_id) {
                return redirect()->back()->with('error', 'Whoops já exite esse produto');
            }
        }

        $createProduct = ProductsTags::create($request->all());
        $createProduct->save();

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public
    function create()
    {

        return view('components.product-create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public
    function store(Request $request): RedirectResponse
    {
        $product = Product::where('name', $request->name)->get();

        if ($product->count() > 0) {
            return redirect()->back()->with('error', 'Whoops já exite esse produto');
        }

        $createProduct = Product::create($request->all());
        $createProduct->save();

        return redirect()->route('product.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public
    function show($id)
    {
        $product = Product::find($id);

        return view('components.product-edit',);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public
    function edit($id)
    {
        $productEdit = Product::find($id);

        return view('components.product-edit', [
            'productEdit' => $productEdit
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public
    function update(Request $request, $id): RedirectResponse
    {
        $productUpdate = Product::where('name', $request->name)->where('id', '!=', $id)->get();

        if ($productUpdate->count() > 0) {
            return redirect()->back()->with('error', 'Produto já cadastrado');
        }

        $productUpdate = Product::where('id', $id)->first();
        $productUpdate->name = $request->name;
        $productUpdate->save();

        return redirect()->route('product.index');

    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public
    function destroy($id): RedirectResponse
    {
        $productDelete = Product::findOrFail($id);
        $productDelete->tags()->detach();
        $productDelete->delete();


        return redirect()->route('product.index')->with('info', "Produto {$productDelete->name} excluído com sucesso !");
    }
}
