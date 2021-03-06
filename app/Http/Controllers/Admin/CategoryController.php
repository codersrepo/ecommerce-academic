<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public $category = null;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = $this->category->latest()->with(['translations' => function ($q) {
            $q->where('language_id', session('language_id'));
        }])
        ->latest()
        ->take(10)
        ->get();
        return view('admin.category.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.form', [
            'category' => $this->category,
            'languages' => Language::get(['language as title', 'prefix', 'id'])
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->prepareSlug($data['title_en']);

        if($request->hasFile('image')){
            $randomize = rand(10,500);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomize.'.'.$extension;
            $image = $request->file('image')->move('images/categories',$filename);
        }
        $data['image'] = $filename;

        if ($category = $this->category->create($data)) {

            $categoryTrans = $this->prepareCategoryTrans($data);

            $category->translations()->createMany($categoryTrans);

        }

                return redirect()->route('category.index')->with('sweet_success','Data added Successfully');

        // return redirect()->route('admin.categories.index');


        // $data = $request->validated();
        // $lang_data = [];
        // foreach($data as $key => $item){
        //     if(is_array(($item))){
        //         $lang_data = $item;
        //         unset($data[$key]);
        //     }
        // }
        // $lang = app()->getlocale();
        // $data[$lang] = $lang_data;
        // $key = array_keys($data);
        // // dd($data[$key['']]);
        // if($request->hasFile('image')){
        //     $randomize = rand(10,500);
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $filename = $randomize.'.'.$extension;
        //     $image = $request->file('image')->move('images/categories',$filename);
        // }
        // $data['slug'] = $this->prepareSlug($data[$key['2']]['title']);

        // $data['image'] = $filename;


        // // dd([
        // //     'data' => $data,
        // //     'key' => $key
        // // ]);
        // $data = Category::create($data);
        //     // $data->image = $filename;
        //     // $data->save();
        // if($data){
        //         return redirect()->route('category.index')->with('sweet_success','Data added Successfully');
        //     } else {
        //         return redirect()->route('category.index')->with('sweet_error','Data couldnot be added');
        // }
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
        $data = Category::FindOrFail($id);
        if($data){
            $data->delete();
            return redirect()->route('category.index')->with('sweet_success','Data deleted successfully');
        } else {
            return redirect()->route('category.index')->with('sweet_error','Data couldnot be deleted');
        }
    }

    // public function toggleStatus(Category $category)
    // {
    //     $category->toggleStatus();

    //     return redirect()->back();
    // }


    private function prepareSlug($sluggableValue)
    {
        $slug = Str::slug($sluggableValue);
        while (true) {
            if ($this->category->where('slug', $slug)->doesntExist()) {
                return $slug;
            }

            $slug .= rand(1, 10000);
        }
    }

    private function prepareCategoryTrans($data)
    {
        $languages = Language::get(['id', 'prefix']);

        return $languages->map(function ($language) use ($data) {
            $title = 'title_' . $language->prefix;
            $summary = 'summary_' . $language->prefix;

            return [
                'title' => $data[$title],
                'summary' => $data[$summary],
                'language_id' => $language->id
            ];
        });
    }


    public function togglestatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 'inactive';
            } else {
                $status = 'active';
            }
            Category::where('id',$data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status,'category_id' => $data['category_id']]);

        }
    }
}
