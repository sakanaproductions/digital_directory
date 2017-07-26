<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tenant;
use App\Building;
use Auth;
use Session;

class TenantController extends Controller
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
        //
        $building_ids = Auth::user()->buildings->implode('id',',');
        $tenants = Tenant::where('building_id', 'in', $building_ids)->paginate(25);

        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $b_id = $request->get('building');

        // If the user doesn't own the building they can't add tenants
        if($key = Auth::user()
            ->buildings
            ->search(function ($item, $key) use ($b_id) {
                return $item->id == $b_id;
            }) === false
        ) {

            return redirect()->route('buildings.index')
            ->with('flash_message', 'You do not have permission to add tenants to that building');

        }

        return view('tenants.create', ['building' => Auth::user()->buildings[$key]]);
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
            'floor' => 'required',
            'unit' => 'required'
        ]);

        $building = Building::find($request->get('building_id'));

        if(!$building) {
            return redirect()->action('BuildingController@index')
                ->with('flash_message', 'Could not save tenant, please try again');
        }

        $tenant = Tenant::create($request->all());
        $building->addTenant($tenant);

        return redirect()->action('BuildingController@show', [$building->id])
            ->with('flash_message', 'Tenant ' . $tenant->name.' added');
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
}
