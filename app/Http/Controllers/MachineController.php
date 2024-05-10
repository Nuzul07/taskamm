<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machine = Machine::all();
        return $machine;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "serNum" => "required",
            "name" => "required",
            "color" => "required",
            "price" => "required",
            "yom" => "required"
        ],[
            "required" => "Must Filled"
        ]);

        $mach = new Machine;
        $mach->serNum = $request->serNum;
        $mach->name = $request->name;
        $mach->color = $request->color;
        $mach->price = $request->price;
        $mach->yom = Carbon::parse($request->yom);
        $mach->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "serNum" => "required",
            "name" => "required",
            "color" => "required",
            "price" => "required",
            "yom" => "required"
        ], [
            "required" => "Must Filled"
        ]);

        $mach = Machine::find($request->id);
        $mach->serNum = $request->serNum;
        $mach->name = $request->name;
        $mach->color = $request->color;
        $mach->price = $request->price;
        $mach->yom = Carbon::parse($request->yom);
        $mach->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $mach = Machine::find($request->machine_id);
        $mach->delete();
        return [
            "status" => "success"
        ];
    }
}
