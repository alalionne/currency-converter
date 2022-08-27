<?php

namespace App\Http\Controllers;

use App\Models\Pair;
use Illuminate\Http\Request;
use App\Http\Requests\PairRequest;

class PairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return 'plop';
        $pair = Pair::with('currencyFrom','currencyTo')->get();
        return response()->json([
            'status' => true,
            'currencies'=> $pair,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PairRequest  $pairRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PairRequest $pairRequest)
    {
        $pair = Pair::create($pairRequest->validated()->all());
        // dd($request->all());
        return response()->json([
            'status' => true,
            'message'=>"ok",
            'post' => $pair
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //on recupère un étudiant si il existe
        $pair = Pair::where("id",$id)->exists();
        if($pair){
            //$info recupère la valeur ou les données de l'etudiant   de l'id trouvé
            $info = Pair::find($id);
            return response()->json([
                "status" => 1,
                "message" => "étudiant trouvée",
                "data" => $info
            ],200);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée",
                "data" => $pair
            ],404);
        }
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
    public function update(PairRequest $pairRequest, Pair $pair)
    {
        $pair->update($pairRequest->all());
        return response()->json([
            'status' => true,
            'message'=>"ok",
            'post' => $pair
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pair = Pair::where("id",$id)->exists();
        if($pair) {
            $pair = Pair::find($id);

            $pair->delete();

            return response()->json([
                "status" => 1,
                "message" => "Suppression réussie"
            ]);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "pair introuvable"
            ]);
        }
    }

    public function convert($value, $currency_from, $currency_to){
       
        $info = Pair::where('currency_id_from',$currency_from)->where('currency_id_to',$currency_to)->first();

        if(!isset($info) || $info == Null){
            return response()->json([
                "status" => 0,
                "message" => "pair introuvable"
            ]);
        }

        $result = $value * $info->rate;
        $info->exchange_number++;

        $info->save();

        return response()->json([
                "status" => 1,
                "message" => "réussie",
                "resultat" => $result,
                "data" => $info
            ]);
    }
}
