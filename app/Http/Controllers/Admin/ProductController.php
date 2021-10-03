<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Models\ProductImage;
use Intervention\Image\Facades\Image;




class ProductController extends Controller
{
    protected $product = null;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =$this->product->latest()->with([
            'translations' => function ($q) {
                $q->where('language_id', session('language_id'));
            },
            'category.translations' => function ($q) {
                $q->where('language_id', session('language_id'))->select();
            },
        ])
            ->latest()
            ->take(10)
            ->get();
        return view('admin.product.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.form', [
            'product' => $this->product->load(['translations']),
            'categories' => Category::active()->with(['translations'])->get(),
            'languages' => Language::get(['language as title', 'prefix', 'id'])
        ]);
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
        // dd($data);
        
        $data['slug'] = $this->prepareSlug($data['title_en']);
        $data['category_id']  = $data['category'];

        if ($request->hasFile('image_icon')) {
            $randomize = rand(10, 500);
            $imageName = $request->file('image_icon')->getClientOriginalName();
            $extension = $request->file('image_icon')->getClientOriginalExtension();
            $filename = $imageName . '-' . rand(1, 900) . '.' . $extension;
            $image = $request->file('image_icon')->move('images/product_images/icons', $filename);
        }
        // dd($filename);
        $data['image_icon'] = $filename;
        // dd($data['image_icon']);
        // $data['image'] = $filename;
        if ($product = $this->product->create($data)) {
            $productTrans = $this->prepareProductTrans($data);

            $product->translations()->createMany($productTrans);

            // $product->sendSubscribersNotification();
        }
        if ($request->hasFile('image_id')) {
            $images = $request->file('image_id');
            foreach ($images as $image) {
                $product_image = new ProductImage();
                $image_tmp = Image::make($image);
                $extension = $image->getClientOriginalExtension();
                $imageName = $image->getClientOriginalName();
                $image_name = $imageName . '-' . rand(1, 900) . '.' . $extension;
                $small_size_image = public_path() . '/images/product_images/small';
                $large_size_image = public_path() . '/images/product_images/large';
                if (!File::isDirectory($small_size_image) && !File::isDirectory($large_size_image)) {
                    File::makeDirectory($small_size_image, 0777, true, true);
                    File::makeDirectory($large_size_image, 0777, true, true);
                }
                Image::make($image_tmp)->resize(520, 600)->save($small_size_image . $image_name);
                Image::make($image_tmp)->save($large_size_image . $image_name);
                $product->images()->create([
                    'images' => $image_name,
                    'product_id' => $product['id']
                ]);
            }
            return redirect()->route('product.index')->with('sweet_success', 'Data added Successfully');
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
        if ($status) {
            return redirect()->route('product.index')->with('sweet_success', 'Data deleted Successfully');
        } else {
            return redirect()->route('product.index')->with('sweet_error', 'Data couldnot be deleted');
        }
    }

    private function prepareProductTrans($data)
    {
        $languages = Language::get(['id', 'prefix']);

        return $languages->map(function ($language) use ($data) {
            $title = 'title_' . $language->prefix;
            $summary = 'summary_' . $language->prefix;
            $description = 'description_' . $language->prefix;

            return [
                'title' => $data[$title],
                'summary' => $data[$summary],
                'description' => $data[$description],
                'language_id' => $language->id
            ];
        });
    }



    public function prepareSlug($sluggableValue)
    {
        $slug = Str::slug($sluggableValue);
        while (true) {
            if (Product::where('slug', $slug)->doesntExist()) {
                return $slug;
            } else {
                $slug = rand(1, 5000);
            }
        }
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 'inactive';
            } else {
                $status = 'active';
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
}
