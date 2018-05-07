<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TargetNumber;
use App\ScheduleLkp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller {

    /**
     * Create a new targetnumber controller instance.
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
        $model = TargetNumber::where('send_type', '!=', '0');
        if (isset($_GET['num']) && $_GET['num'] != '') {
            $model = $model->where('target_number', 'like', '%' . $_GET['num'] . '%');
        }
        if (isset($_GET['type']) && $_GET['type'] != '') {
            $model = $model->where('is_suspended', $_GET['type']);
        }

        $model = $model->orderBy('id', 'desc')->paginate(10);

        return view('schedule.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $model = new TargetNumber();
        $sch_lkp = ScheduleLkp::all();
        return view('schedule.create', ['model' => $model, 'sch_lkp' => $sch_lkp]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $model = new TargetNumber();
        $request->flash(); //save the input before redirect

        $rules = [
            'target_number' => 'required|unique:target_numbers',
            'send_type' => 'required',
            'send_start_date' => 'required',
            'message' => 'required',
            'schedule_id' => 'required_if:send_type,2'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->target_number = $request->input("target_number");
            $model->send_type = $request->input("send_type");
            $model->send_start_date = $request->input("send_start_date");
            $model->message = $request->input("message");
            $model->schedule_id = $request->input("schedule_id");
            $model->is_suspended = $request->input("is_suspended") ? $request->input("is_suspended") : 0;

            $model->save();

            return redirect()->route('sms-schedule.index')->with('message', 'Item created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    /* public function show($id) {
      $model = TargetNumber::findOrFail($id);
      $inbounds = \App\InOutBoundSms::where('is_outbound', 0)->where('sent_from', $model->target_number)->orderBy('id', 'desc')->get();
      $outbounds = \App\InOutBoundSms::where('is_outbound', 1)->where('sent_to', $model->target_number)->orderBy('id', 'desc')->get();

      return view('targetnumber.show', array('model' => $model, 'inbounds' => $inbounds, 'outbounds' => $outbounds));
      } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $model = TargetNumber::findOrFail($id);
        $sch_lkp = ScheduleLkp::all();

        return view('schedule.edit', ['model' => $model, 'sch_lkp' => $sch_lkp]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id) {
        $model = TargetNumber::findOrFail($id);
        $request->flash(); //save the input before redirect
        $rules = [
            'target_number' => 'required|unique:target_numbers,' . $id,
            'send_type' => 'required',
            'send_start_date' => 'required',
            'message' => 'required',
            'schedule_id' => 'required_if:send_type,2'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->target_number = $request->input("target_number");
            $model->send_type = $request->input("send_type");
            $model->send_start_date = $request->input("send_start_date");
            $model->message = $request->input("message");
            $model->schedule_id = $request->input("schedule_id");
            $model->is_suspended = $request->input("is_suspended") ? $request->input("is_suspended") : 0;

            $model->save();

            return redirect()->route('sms-schedule.index')->with('message', 'Item updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $model = TargetNumber::findOrFail($id);
        $model->send_type = '0';
        $model->save();
        //$model->delete();

        return redirect()->route('sms-schedule.index')->with('message', 'Item deleted successfully.');
    }

}
