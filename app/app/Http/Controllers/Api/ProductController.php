<?php

namespace App\Http\Controllers\Api;

use App\Events\CreateProduct;
use App\Helpers\URLHelper;
use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $total = Product::count();
        $max = (int) $request->get('max') ?: $total;
        $page = (int) $request->get('page') ?: 1;

        $pages = URLHelper::pagesCalculation($max, $page, $total);

        $products = Product::query()->limit($max)->skip($pages['offset'])->orderBy('created_at');

        return $this->sendPagedResponse($products->get()->toArray(), $max, $pages['nextPage'], $pages['lastPage'], $pages['currentPage'], 'products.all');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'bail|required|unique:products|max:255',
            'title' => 'required|max:255',
            'url' => 'required|url|max:255',
            'description' => 'required',
            'abstract' => 'required',
            'price' => 'required|numeric|max:255',
            'image_url' => 'required|url|max:255',
            'stock' => 'required|numeric|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);

        }

        event(new CreateProduct($request->all()));

        return $this->sendResponse(null, 'Product created successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);


        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }


        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }


}
