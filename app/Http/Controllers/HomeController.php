<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            return redirect('home');
        }
        else {

            $doctor = Doctor::all();

            return view('user.home', compact('doctor'));
        }
    }
    public function redirect()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == '0')
            {
                $doctor = Doctor::all();

                return view('user.home', compact('doctor'));
            }
            else
            {
                $appointment = Appointment::all();
                return view('admin.home', compact('appointment'));
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    public function showDoctors()
    {
        $doctor = Doctor::all();
        return view('user.doctor',compact('doctor'));
    }
    public function appointment(Request $request)
    {
        if(Auth::id()) {
            $data = new Appointment;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->doctor = $request->doctor;
            $data->date = $request->date;
            $data->message = $request->message;
            $data->status = 'In progress';
            $data->user_id = Auth::user()->id;
            $data->save();

            return redirect()->back()->with('message', 'success');
        }
        else
            return redirect('/')->with('message', 'failed');
    }
    public function showAppointments()
    {
        if(Auth::id())
        {
            $user_id = Auth::user()->id;
            $appointment = Appointment::where('user_id', $user_id)->get();
            $appoint_count = $appointment->count();

            return view('user.show_appointments', compact('appointment', 'appoint_count'));
        }
        else
            return redirect()->back();
    }
    public function cancelAppoint($id)
    {
        $data = Appointment::find($id);
        $data->delete();

        return redirect()->back()->with([
            'message' => 'Appointment cancelled successfully',
            'status' => 'danger'
        ]);
    }

}
