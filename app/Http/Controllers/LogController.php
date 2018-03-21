<?php

namespace App\Http\Controllers;

use App\SmsLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller {

    /**
     * Create a new Log controller instance.
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
        $model = SmsLog::where('seen', 0)->orderBy('id', 'desc')->paginate(10);

        return view('log.index', array('model' => $model, 'seen' => 0));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexSeen() {
        $model = SmsLog::where('seen', 1)->orderBy('id', 'desc')->paginate(10);

        return view('log.index', array('model' => $model, 'seen' => 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $model = new SmsLog();
        return view('log.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $model = new SmsLog();
        $request->flash(); //save the input before redirect

        $validator = Validator::make($request->all(), $model->rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->sent_from = $request->input("sent_from");
            $model->sent_to = $request->input("sent_to");
            $model->message = trim($request->input("message"));
            $model->reply = trim($request->input("reply"));

            $model->save();

            return redirect()->route('sms-log.index')->with('message', 'Item created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $model = SmsLog::findOrFail($id);

        return view('log.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $model = SmsLog::findOrFail($id);

        return view('log.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $id) {
        $model = SmsLog::findOrFail($id);
        $request->flash(); //save the input before redirect
        $validator = Validator::make($request->all(), $model->rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->sent_from = $request->input("sent_from");
            $model->sent_to = $request->input("sent_to");
            $model->message = trim($request->input("message"));
            $model->reply = trim($request->input("reply"));

            $model->save();

            return redirect()->route('sms-log.index')->with('message', 'Item updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $model = SmsLog::findOrFail($id);
        $model->delete();

        return redirect()->route('sms-log.index')->with('message', 'Item deleted successfully.');
    }

    /**
     * Export the specified resource from storage.
     *
     */
    public function export() {
        $seen = $_GET['type'];
        $logs = SmsLog::where('seen', $seen)->get([
                    \DB::raw('sent_from as `SMS Ph# Received From`'), \DB::raw('message as `SMS Message Received`'),
                    \DB::raw('sent_to as `Twilio # Sent To`'), \DB::raw('reply as `Twilio Message Reply Sent`')
                ])
                ->toArray();
        if(!$seen){
            SmsLog::query()->update(['seen' => 1]);
        }
        return \Excel::create('SMS-Logs', function($excel) use ($logs) {
                    $excel->sheet('SMS-Logs', function($sheet) use ($logs) {
                        $sheet->fromArray($logs);
                    });
                })->download('csv');
    }

}
