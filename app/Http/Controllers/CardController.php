<?php

namespace App\Http\Controllers;

use App\Card;
use App\StatusCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function index()
    {
        $datas=StatusCard::with('cards')->get();

        return response()->json([
            'message'=>'Datos obtenidos',
            'errors'=>null,
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'user_id'=>'required|exists:users,id',
            'status_card_id'=>'required|exists:status_cards,id',
            'date_delivery'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>null,
                'errors'=>$validation->errors(),
                'datas'=>null
            ],422);
        }

        try {
            $response=Card::create($request->all());

            return response()->json([
                'message'=>'Card agregada exitosamente',
                'errors'=>null,
                'datas'=>$response
            ],201);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgiso un error al intentar agregar el card.',
                'errors'=>$th,
                'datas'=>null
            ],500);
        }

    }

    public function edit(Card $card, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'status_card_id'=>'required|exists:status_cards,id',
            'date_delivery'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>null,
                'errors'=>$validation->errors(),
                'datas'=>null
            ],422);
        }

        try {
            $card->name=$request->name;
            $card->date_delivery=$request->date_delivery;
            $response=$card->save();

            if ($response) {
                return response()->json([
                    'message'=>"Card actualizado exitosamente.",
                    'errors'=>null,
                    'datas'=>$card
                ],201);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>"Ha surgido un error al tratar de actualizar el card.",
                'errors'=>null,
                'datas'=>null
            ],422);
        }
    }
}
