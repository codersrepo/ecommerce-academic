<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::translatedIn(app()->getLocale())
        ->latest()
        ->take(10)
        ->get();
        return view('admin.product.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::translatedIn(app()->getLocale())->get();
        return view('admin.product.form')->with('category_data',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $lang_data = [];
        foreach($data as $key => $item){
            if(is_array(($item))){
                $lang_data = $item;
                unset($data[$key]);
            }
        }
        $lang = app()->getlocale();
        $data[$lang] = $lang_data;
        $key = array_keys($data);
        // dd($data);
        // dd($data[$key['6']]);
        $product = new Product();
        if($request->hasFile('image_icon')){
            $randomize = rand(10,500);
            $extension = $request->file('image_icon')->getClientOriginalExtension();
            $filename = $randomize.'.'.$extension;
            $image = $request->file('image_icon')->move('images/product_images/icons',$filename);
        }
            if($request->hasFile('video')){
                $video_temp  = $request->file('video');
                $videoName = $video_temp->getClientOriginalName();
                $extension = $video_temp->getClientOriginalExtension();
                $video_name = $videoName.'-'.rand(1,900).'.'.$extension;
                $video_path = public_path().'/videos/product_video/';
                $video_temp->move($video_path,$video_name);
                $data['video'] = $video_name;
            }

        $data['image_icon'] = $filename;
                    $data['slug'] = $this->prepareSlug($data[$key['6']]['title']);

        // $data['images'] = $image_name;
        // if(app()->getlocale()== 'en'){
        //     $data['slug'] = $this->prepareSlug($data[$key['2']]['title']);
        // }
        // else{

        //     $data['slug'] = $this->prepareSlug($data[$key['2']]['title']);
        // }     
              $data['image'] = $filename;
        // $data['images'] = $image_name;
        $product = Product::create($data);
        // dd($product);


        //   storing images in database
        if($request->hasFile('image_id')){
            $images = $request->file('image_id');
            foreach($images as $image){
                $product_image = new ProductImages();
                $image_tmp = Image::make($image);
                $extension = $image->getClientOriginalExtension();
                $imageName = $image->getClientOriginalName();
                $image_name = $imageName.'-'.rand(1,900).'.'.$extension;
                $small_size_image = public_path().'/images/product_images/small';
                $large_size_image = public_path().'/images/product_images/large';
                if(!File::isDirectory($small_size_image) && !File::isDirectory($large_size_image)){
                    File::makeDirectory($small_size_image, 0777, true, true);
                    File::makeDirectory($large_size_image, 0777, true, true);
                }
                Image::make($image_tmp)->resize(520,600)->save($small_size_image.$image_name);
                Image::make($image_tmp)->save($large_size_image.$image_name);
                $product->images()->create([
                    'images' => $image_name,
                    'product_id' => $product['id']
                ]);
            }

            // $data->image = $filename;
            // $data->save();
        if($product){
                return redirect()->route('product.index')->with('sweet_success','Data added Successfully');
            } else {
                return redirect()->route('product.index')->with('sweet_error','Data couldnot be added');
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        $status = $data->delete();
            if($status){
                return redirect()->route('product.index')->with('sweet_success','Data deleted Successfully');
            } else {
                return redirect()->route('product.index')->with('sweet_error','Data couldnot be deleted');
            }
    }

    public function prepareSlug($sluggableValue){
        $slug = Str::slug($sluggableValue);
        while(true){
            if(Product::where('slug',$slug)->doesntExist()){
                return $slug;
            } else {
                $slug = rand(1,5000);
            }

        }
    }

    public function toggleStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 'inactive';
            } else {
                $status = 'active';
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
           return response()->json(['status' => $status,'product_id' => $data['product_id']]);
        }
    }

}
