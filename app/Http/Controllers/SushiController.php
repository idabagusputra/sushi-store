<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator, Redirect};
use Inertia\Inertia;
use Carbon\Carbon;

class SushiController extends Controller
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
        $sort = $request->query("sort");
        $sushis = DB::table("sushis")
            ->select(
                DB::raw("
                sushis.id as id, sushis.name as name, sushi_types.id as sushi_type_id,
                sushi_types.name as sushi_type_name, sushi_masters.id as sushi_master_id,
                sushi_masters.name as sushi_master_name, sushis.quantity as quantity,
                sushis.price as price, sushis.deleted_at as deleted_at
            ")
            )
            ->join("sushi_types", "sushi_types.id", "=", "sushis.type_id")
            ->join("sushi_masters", "sushi_masters.id", "=", "sushis.master_id")
            ->where("sushis.deleted_at", "=", null);
        if (!empty($search)) {
            $sushis = $sushis
                ->where("sushis.name", "like", "%$search%")
                ->orWhere("sushi_types.name", "like", "%$search%")
                ->orWhere("sushi_masters.name", "like", "%$search%");
        }
        if (!empty($sort)) {
            $sushis = $sushis->orderBy(
                "sushis.name",
                $sort === "true" ? "asc" : "desc"
            );
        }
        return Inertia::render("Sushis/Index", [
            "sushis" => $sushis->get(),
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
        $trashedSushis = DB::table("sushis")
            ->select(
                DB::raw("
                sushis.id as id, sushis.name as name, sushi_types.id as sushi_type_id,
                sushi_types.name as sushi_type_name, sushi_masters.id as sushi_master_id,
                sushi_masters.name as sushi_master_name, sushis.quantity as quantity,
                sushis.price as price, sushis.deleted_at as deleted_at
            ")
            )
            ->where("sushis.deleted_at", "!=", null)
            ->join("sushi_types", "sushi_types.id", "=", "sushis.type_id")
            ->join("sushi_masters", "sushi_masters.id", "=", "sushis.master_id")
            ->get();
        return Inertia::render("Sushis/Trashed", [
            "trashed_sushis" => $trashedSushis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sushiTypes = DB::table("sushi_types")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $sushiMasters = DB::table("sushi_masters")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        return Inertia::render("Sushis/Create", [
            "sushi_types" => $sushiTypes,
            "sushi_masters" => $sushiMasters,
        ]);
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
                "type" => ["required", "integer", "exists:sushi_types,id"],
                "master" => ["required", "integer", "exists:sushi_masters,id"],
                "name" => ["required", "string", "max:255"],
                "quantity" => ["required", "integer", "min:0"],
                "price" => ["required", "integer", "min:0"],
            ],
            [],
            [
                "type" => "sushi type",
                "master" => "sushi master",
                "name" => "sushi name",
                "quantity" => "sushi quantity",
                "price" => "sushi price",
            ]
        );
        DB::table("sushis")->insert([
            "type_id" => $request->type,
            "master_id" => $request->master,
            "name" => $request->name,
            "quantity" => $request->quantity,
            "price" => $request->price,
        ]);
        return Redirect::route("sushis.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sushiTypes = DB::table("sushi_types")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $sushiMasters = DB::table("sushi_masters")
            ->select(DB::raw("id, name, deleted_at"))
            ->where("deleted_at", "=", null)
            ->get();
        $sushi = DB::table("sushis")
            ->select(
                DB::raw("
                sushis.id as id, sushis.name as name, sushi_types.id as sushi_type_id,
                sushi_types.name as sushi_type_name, sushi_masters.id as sushi_master_id,
                sushi_masters.name as sushi_master_name, sushis.quantity as quantity,
                sushis.price as price, sushis.deleted_at as deleted_at
            ")
            )
            ->where("sushis.id", "=", $id)
            ->where("sushis.deleted_at", "=", null)
            ->join("sushi_types", "sushi_types.id", "=", "sushis.type_id")
            ->join("sushi_masters", "sushi_masters.id", "=", "sushis.master_id")
            ->get();
        return Inertia::render("Sushis/Edit", [
            "sushi_types" => $sushiTypes,
            "sushi_masters" => $sushiMasters,
            "sushi" => $sushi[0],
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
                "type" => ["required", "integer", "exists:sushi_types,id"],
                "master" => ["required", "integer", "exists:sushi_masters,id"],
                "name" => ["required", "string", "max:255"],
                "quantity" => ["required", "integer", "min:0"],
                "price" => ["required", "integer", "min:0"],
            ],
            [],
            [
                "type" => "sushi type",
                "master" => "sushi master",
                "name" => "sushi name",
                "quantity" => "sushi quantity",
                "price" => "sushi price",
            ]
        );
        DB::table("sushis")
            ->where("id", "=", $id)
            ->update([
                "type_id" => $request->type,
                "master_id" => $request->master,
                "name" => $request->name,
                "quantity" => $request->quantity,
                "price" => $request->price,
                "updated_at" => Carbon::now(),
            ]);
        return Redirect::route("sushis.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("sushis")
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
        DB::table("sushis")
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
        DB::table("sushis")
            ->where("id", "=", $id)
            ->where("deleted_at", "!=", null)
            ->update([
                "deleted_at" => null,
            ]);
        return back();
    }
}
