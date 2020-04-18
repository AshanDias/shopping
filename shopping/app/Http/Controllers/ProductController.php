<?php
namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use \App;
use App\ProductDetails;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::get();
    }


    public function getProuctDetails()
    {
       
        $response=DB::table('product_details')
        ->join('products','products.id','=','product_details.product_id')
        ->select('products.name as product','product_details.*')->get();
        return $response;
    }

    public function details($id)
    {
        $response=DB::table('product_details')
        ->join('products','products.id','=','product_details.product_id')
        ->where('product_details.id',$id)
        ->select('products.name as product','product_details.*')->get();
        return $response;
    }

    public function getDetailsByID(Request $request)
    {
        $id=$request->id;

        $response=DB::table('product_details')
        ->join('products','products.id','=','product_details.product_id')
        ->where('product_details.product_id',$id)
        ->select('products.name as product','product_details.*')->get();
        return $response;
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
        $file =$request->file('image');
        $filenamewithextension = $file->getClientOriginalName();
       $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

       $extension = $file->getClientOriginalExtension();

       $filenametostore = $filename.'_'.uniqid().'.'.$extension;

       $img_path = "public/upload/".$request->s_name."/";
       
       Storage::put($img_path. $filenametostore, fopen($file, 'r+'));

       $image_path= $img_path.$filenametostore;
       $url = Storage::url($image_path);
     
        $product=new ProductDetails();
        $product->product_id=$request->ctgry;
        $product->shortName=$request->s_name;
        $product->longName=$request->l_name;
        $product->imagePath=$url;
        $product->price=$request->price;
        $product->desc=$request->des;
         $product->save();
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
