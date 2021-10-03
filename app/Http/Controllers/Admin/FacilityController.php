<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacilityRequest;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Language;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    protected $facility;

    public function __construct(Facility $facility)
    {
        $this->facility = $facility;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.facility.form', [
            'facility' => $this->facility,
            'languages' => Language::get(['language as title', 'prefix', 'id'])
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityRequest $request)
    {
        $data = $request->validated();
        
        $data['slug'] = $this->prepareSlug($data['title_en']);

        if ($facility = $this->facility->create($data)) {

            $facilityTrans = $this->prepareFacilityTrans($data);

            $facility->translations()->createMany($facilityTrans);
        }

        // Alert::show($facility, 'add');

        return redirect()->route('admin.facility.index')->with('sweet_success','Data added Successfully');

        // return redirect()->route('admin.facility.index');
    }

    private function prepareFacilityTrans($data)
    {
        $languages = Language::get(['id', 'prefix']);

        return $languages->map(function ($language) use ($data) {
            $title = 'title_' . $language->prefix;

            return [
                'title' => $data[$title],
                'language_id' => $language->id
            ];
        });
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
        //
    }

    private function prepareSlug($sluggableValue)
    {
        $slug = Str::slug($sluggableValue);
        // dd($slug);
        while (true) {
            if ($this->facility->where('slug', $slug)->doesntExist()) {
                return $slug;
            }
            $slug .= rand(1, 10000);
        }
    }

}
