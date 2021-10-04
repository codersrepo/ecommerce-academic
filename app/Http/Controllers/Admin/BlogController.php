<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public $blog = null;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->blog->latest()->with(['translations' => function ($q) {
            $q->where('language_id', session('language_id'));
        }])
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
        return view('admin.blog.form', [
            'blog' => $this->blog,
            'languages' => Language::get(['language as title', 'prefix', 'id'])
        ]);
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
        $data['slug'] = $this->prepareSlug($data['title_en']);

        if($request->hasFile('image')){
            $randomize = rand(10,500);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomize.'.'.$extension;
            $image = $request->file('image')->move('images/blogs',$filename);
        }
        $data['image'] = $filename;

        if ($blog = $this->blog->create($data)) {

            $blogTrans = $this->prepareblogTrans($data);

            $blog->translations()->createMany($blogTrans);

        }

                return redirect()->route('blog.index')->with('sweet_success','Data added Successfully');

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

    private function prepareSlug($sluggableValue)
    {
        $slug = Str::slug($sluggableValue);
        while (true) {
            if ($this->blog->where('slug', $slug)->doesntExist()) {
                return $slug;
            }

            $slug .= rand(1, 10000);
        }
    }

    private function prepareBlogTrans($data)
    {
        $languages = Language::get(['id', 'prefix']);

        return $languages->map(function ($language) use ($data) {
            $title = 'title_' . $language->prefix;
            $summary = 'summary_' . $language->prefix;
            $description = 'description_' . $language->prefix;

            return [
                'title' => $data[$title],
                'description' => $data[$description],
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
            Blog::where('id',$data['blog_id'])->update(['status' => $status]);
            return response()->json(['status' => $status,'blog_id' => $data['blog_id']]);

        }

    }
}
