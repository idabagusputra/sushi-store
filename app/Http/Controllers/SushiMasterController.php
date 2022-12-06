<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator, Redirect};
use Inertia\Inertia;
use Carbon\Carbon;

class SushiMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query("search");
        if (empty($search)) {
            $sushiMasters = DB::table("sushi_masters")
                ->select(DB::raw("id, name, deleted_at"))
                ->where("deleted_at", "=", null)
                ->get();
        } else {
            $sushiMasters = DB::table("sushi_masters")
                ->select(DB::raw("id, name, deleted_at"))
                ->where("deleted_at", "=", null)
                ->where("name", "like", "%$search%")
                ->get();
        }
        return Inertia::render("SushiMasters/Index", [
            "sushi_masters" => $sushiMasters,
        ]);
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $trashedSushiMasters = DB::table("sushi_masters")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "!=", null)
            ->get();
        return Inertia::render("SushiMasters/Trashed", [
            "trashed_sushi_masters" => $trashedSushiMasters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("SushiMasters/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::validate(
            $request->all(),
            [
                "name" => ["required", "string", "max:255"],
            ],
            [],
            [
                "name" => "sushi master name",
            ]
        );
        DB::table("sushi_masters")->insert([
            "name" => $request->name,
        ]);
        return Redirect::route("sushis.masters.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sushiMaster = DB::table("sushi_masters")
            ->where("id", "=", $id)
            ->get();
        return Inertia::render("SushiMasters/Edit", [
            "sushi_master" => $sushiMaster[0],
        ]);
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
        Validator::validate(
            $request->all(),
            [
                "name" => ["required", "string", "max:255"],
            ],
            [],
            [
                "name" => "sushi master name",
            ]
        );
        DB::table("sushi_masters")
            ->where("id", "=", $id)
            ->update([
                "name" => $request->name,
                "updated_at" => Carbon::now(),
            ]);
        return Redirect::route("sushis.masters.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("sushi_masters")
            ->where("id", "=", $id)
            ->update([
                "deleted_at" => Carbon::now(),
            ]);
        return back();
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_permanent($id)
    {
        DB::table("sushi_masters")
            ->where("id", "=", $id)
            ->delete();
        return back();
    }

    /**
     * Restore the specified trashed resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        DB::table("sushi_masters")
            ->where("id", "=", $id)
            ->where("deleted_at", "!=", null)
            ->update([
                "deleted_at" => null,
            ]);
        return back();
    }
}
