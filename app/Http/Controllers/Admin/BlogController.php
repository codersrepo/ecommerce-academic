<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::translatedIn(app()->getLocale())
        ->latest()
        ->take(10)
        ->get();
        return view('admin.blog.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
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
        if($request->hasFile('image')){
            $randomize = rand(10,500);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomize.'.'.$extension;
            $image = $request->file('image')->move('images/blogs',$filename);
        }
        // dd($data);
        // $data['slug'] = Str::slug($request->title);
        $data['slug'] = $this->prepareSlug($data[$key['2']]['title']);
        $data['image'] = $filename;
        print_r($data);
        $data = Blog::create($data);
            // $data->image = $filename;
            // $data->save();
        if($data){
                return redirect()->route('blog.index')->with('sweet_success','Data added Successfully');
            } else {
                return redirect()->route('blog.index')->with('sweet_error','Data couldnot be added');
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
        $data = Blog::FindOrFail($id);
        if($data){
            $data->delete();
            return redirect()->route('blog.index')->with('sweet_success','Data deleted successfully');
        } else {
            return redirect()->route('blog.index')->with('sweet_error','Data couldnot be deleted');
        }
    }

    public function togglestatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 'inactive';
            } else {
                $status = 'active';
            }
            Blog::where('id',$data['blog_id'])->update(['status' => $status]);
            return response()->json(['status' => $status,'blog_id' => $data['blog_id']]);

        }
    }


    public function prepareSlug($slggableValue){
        $slug = Str::slug($slggableValue);
        while(true){
            if(Blog::where('slug',$slug)->doesntExist()){
                return $slug;
            }
            $slug = rand(1,5000);
        }
    }



}
