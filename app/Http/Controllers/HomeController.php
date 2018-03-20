<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $model = Number::orderBy('id', 'desc')->paginate(10);

        return view('home.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $model = new Number();
        return view('home.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $model = new Number();
        $request->flash(); //save the input before redirect

        $validator = Validator::make($request->all(), $model->rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->number = $request->input("number");
            $model->msg = trim($request->input("msg"));

            $model->save();

            return redirect()->route('home.index')->with('message', 'Item created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $model = Number::findOrFail($id);

        return view('home.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $model = Number::findOrFail($id);

        return view('home.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id) {
        $model = Number::findOrFail($id);
        $request->flash(); //save the input before redirect
        $rules = [
            'number' => 'required|min:6|max:6|unique:numbers,' . $id,
            'msg' => 'required|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->number = $request->input("number");
            $model->msg = trim($request->input("msg"));

            $model->save();

            return redirect()->route('home.index')->with('message', 'Item updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $model = Number::findOrFail($id);
        $model->delete();

        return redirect()->route('home.index')->with('message', 'Item deleted successfully.');
    }

}
