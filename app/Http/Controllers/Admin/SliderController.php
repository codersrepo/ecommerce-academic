<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slider::translatedIn(app()->getLocale())
        ->latest()
        ->take(10)
        ->get();
        return view('admin.slider.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        if($request->hasFile('image')){
            $randomize = rand(10,500);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomize.'.'.$extension;
            $image = $request->file('image')->move('images/sliders',$filename);
          }
            $data = Slider::create($request->validated());
            $data->image = $filename;
            $data->save();
            if($data){
            return redirect()->route('slider.index')->with('sweet_success','Data Added Successfully');
        } else {
            return redirect()->route('slider.index')->with('sweet_error','Data Couldnot be Added Successfully');
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
        $data = Slider::find($id);
        $status = $data->delete();
        if($status){
            return redirect()->route('slider.index')->with('sweet_success','Data Deleted Successfully');
        } else {
            return redirect()->route('slider.index')->with('sweet_error','Data couldnot be deleted Successfully');

        }
    }
}
