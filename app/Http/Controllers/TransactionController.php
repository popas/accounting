<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Events\TransactionCreated;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransactionResource::collection(Transaction::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'amount' => 'required',
                'type'   => 'required',
                'title'  => 'required'
            ]
        );

        $transaction = Transaction::create(
            [
                'amount'    => $request->amount,
                'author_id' => Auth::user()->id,
                'title'     => $request->title,
                'type'      => $request->type,
            ]
        );

        TransactionCreated::dispatch($transaction);

        return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Transaction $transaction)
    {
        if ($transaction->author_id !== Auth::user()->id) {
            return response()->json(['success' => false, 'message' => "You're not allowed"]);
        }

        $transaction->fill(request()->all());
        $transaction->save();

        return new TransactionResource($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->author_id !== Auth::user()->id) {
            return response()->json(['success' => false, 'message' => "You're not allowed"]);
        }

        $transaction->delete();
        return response()->json(['success' => true]);
    }
}
