<?php

namespace App\Http\Controllers;

use App\Attendance\Trip;
use App\Attendance\RollCall;
use Illuminate\Http\Request;
use App\Attendance\Attendance;

class RollCallController extends Controller
{
    public $attendance;
    public $rollCall;
    public $trip;
    function __construct(Attendance $attendance, RollCall $rollCall, Trip $trip)
    {
        $this->attendance =  $attendance;
        $this->rollCall = $rollCall;
        $this->trip = $trip;
    }
	public function present(Request $request, $name)
	{
        $rollcall = $this->rollCall->firstOrCreate([
            'date' => $request->input('date'), 
            'trip_id' => $request->input('trip')
            ]);
        $user = $this->attendance->firstOrCreate(['name' => $name]);
        $user->rollCalls()->sync([$rollcall->id => ['present' => true]]);
        $user =  $user->toArray();
        $user['rollCall'] = $rollcall->id; 
		return response()->json($user, 200);
	}

    public function absent(Request $request, $id)
    {
        $rollcall = $this->rollCall->where('date', $request->input('date'))->first();
        $user = $this->attendance->find($id);
        return $user->rollCalls()->detach($rollcall->id);
        return response()->json($user, 200);
    }

    public function dateAttendances(Request $request, $date)
    {
        $rollcall = $this->rollCall->where('date', $date)->with('attendances')->first();
        return view('rollCall.dateAttendances', ['rollCall' => $rollcall]);
    }

    public function activeTrips(Request $request)
    {
        return $this->trip->where('active', true)->get();

    }
	public function suggestUsers(Request $request, $name)
	{
		return Attendance::where('name', 'like', $name . '%')->get();
	}

  public function selectTrip(Request $request)
  {
    $trips = $this->trip->where('active', true)->get();
    return view("rollCall.selectTrip",["trips" => $trips]);
}

public function createRollCall(Request $request, $id){
    return view("rollCall.rollCall",["trip" => $id]);
}

public function token(Request $request){
        return view('rollCall.token');
    }

    public function generateToken(Request $request){
        return rand(1, 100000);
    }





    
}
