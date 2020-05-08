<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;
use App\Http\Requests\PublisherRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagi = config('seting.paginate');
        $filters = request()->only('action', 'key');

        if($filters && $filters['action'] == 'search'){
            // for search
            $publisher = Publisher::where('name_publisher', 'like', '%'.$filters['key'].'%')
                                        ->orderBy('id','ASC')->paginate($pagi);
        }
        else{
            
            $publisher = Publisher::orderBy('id','ASC')->paginate($pagi);
        }
        
        return view('publishers.publisher', ['publisher' => $publisher]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publishers.add_publisher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublisherRequest $request)
    {
        try {
            $publisher = [
            'name_publisher' => $request->name_publisher,
            'email' => $request->email,
            'address' => $request->address,
        ];
        Publisher::create($publisher);

        return redirect()->back()->with(['create_success' => trans('controller/user.create_success') ]);
        } catch (ModelNotFoundException $e) {
            throw new Exception($e->getMessage());
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
        try {
            $publisher = Publisher::where('id', $id)->first();
            
            return view('publishers.edit_publisher',compact('publisher'));
        } catch (ModelNotFoundException $e) {
            throw new Exception($e->getMessage());
        }
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
        try {
            $publisher = [
            'name_publisher' => $request->name_publisher,
            'email' => $request->email,
            'address' => $request->address,
        ];
        Publisher::where('id', '=', $id)->update($publisher);

        return redirect()->back()->with(['update_success' => trans('controller/user.update_success') ]);
        } catch (ModelNotFoundException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::destroy($id);

        return redirect('publishers')->with(['delete_success' => trans('controller/user.delete_success') ]);
    }
}
