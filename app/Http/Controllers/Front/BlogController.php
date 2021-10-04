<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    protected $blog;


    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }


    public function index(Request $request){
        $blog = $this->blog
            ->active()
            ->when($request->q, function ($q, $title) {
                $q->whereHas('translations', function ($q) use ($title) {
                    $q->correctTranslation()->where('title', 'LIKE', "%{$title}%");
                });
            })
            ->latest()
            ->with(['translations' => function ($q) {
                $q->correctTranslation()->select(['title', 'blog_id']);
            }])
            ->paginate(9);
        return view('user.blog.index', compact(['blog']));

    }

    public function show($slug){
        $blog_data =  $this->blog->active()
            ->with(['translations' => function ($q) {
                $q->correctTranslation();
            }])->where('slug', $slug)
            ->first();


        return view('user.blog.show')
                                    ->with('blog_data',$blog_data);
    }
}
