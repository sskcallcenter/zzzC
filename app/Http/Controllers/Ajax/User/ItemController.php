<?php

namespace App\Http\Controllers\Ajax\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ajax\User\ItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 200;
        $message = null;
        $data = Item::orderBy('id', 'desc')->paginate(3);
        return response()->json(['result' => $data, 'status' => $status, 'message' => $message]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $status = 200;
        $message = null;

        $data = $request->all();
        $data['checkbox'] = implode(',', $data['checkbox']);    // 配列をカンマ区切りのテキストに変換
        $item = new Item();
        $result = $item->fill($data)->save();

        return response()->json(['post' => $data, 'status' => $status, 'message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 200;
        $message = null;

        $data = null;
        $item = Item::find($id);
        if ($item) {
            $data = $item;
            $data['checkbox'] = explode(',', $data['checkbox']);
        } else {
            $status = 404;
            $message = 'Not Found.';
        }

        return response()->json(['item' => $data, 'status' => $status, 'message' => $message]);
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
    public function update(ItemRequest $request, $id)
    {
        $status = 200;
        $message = null;
        $result = false;

        $data = $request->all();
        $data['checkbox'] = implode(',', $data['checkbox']);
        $item = Item::find($id);
        if ($item) {
            $result = $item->fill($data)->save();
        } else {
            $status = 404;
            $message = 'Not Found.';
        }

        return response()->json(['result' => $result, 'status' => $status, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 200;
        $message = null;
        $result = 1;
        $item = Item::find($id);
        if ($item) {
            $result = $item->delete();
        }
        return response()->json(['result' => $result, 'status' => $status, 'message' => $message]);
    }
}
