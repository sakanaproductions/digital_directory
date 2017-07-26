<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Building;
use Auth;
use Session;

class BuildingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Auth::user()->buildings()->paginate(10);

        return view('buildings.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required|max:2',
            'postal_code' => 'required',
            'floors' => 'required'
        ]);

        $request->merge(['owner_id' => Auth::user()->id]);

        $building = Building::create($request->all());

        return redirect()->route('buildings.index')
            ->with('flash_message', 'Building ' . $building->name.' created');
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
        $building =  Building::findOrFail($id);

        return view ('buildings.show', compact('building'));
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
        $building =  Building::findOrFail($id);

        return view ('buildings.edit', compact('building'));
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
        $this->validate($request, [
            'name' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'floors' => 'required'
        ]);

        $building = Building::findOrFail($id);

        $building->name = $request->input('name');
        $building->address1 = $request->input('address1');
        $building->address2 = $request->input('address2');
        $building->city = $request->input('city');
        $building->state = $request->input('state');
        $building->postal_code = $request->input('postal_code');
        $building->floors = $request->input('floors');

        return redirect()->route('buildings.index')
            ->with('flash_message', 'Building ,
             '. $building->name.' updated');
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
        $building = Building::findOrFail($id);
        $building->delete();

        return redirect()->route('building.index')
            ->with('flash_message',
             'Building successfully deleted');
    }
}
