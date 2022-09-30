<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            return redirect('home');
        }
        else
        {
            $doctors = doctor::all();

            return view('user.home', compact('doctors'));
        }

    }

    public function redirect()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 0)
            {
                $doctors = doctor::all();

                return view('user.home', compact('doctors'));
            }
            else
                return view('admin.home');
        }
        else
            return redirect()->back();
    }

    public function doctorsView()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 0)
            {
                $doctors = doctor::all();

                return view('user.home', compact('doctors'));
            }
            else
                return view('admin.home');
        }
        else
            return redirect()->back();
    }

    public function makeAppointment(Request $request)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (Auth::id())
            {
                if (Auth::user()->usertype == 0)
                {
                    $request->validate([
                        'name' => 'required',
                        'email' => 'required',
                        'date' => 'required',
                        'phone' => 'required',
                        'message' => 'required',
                        'doctor' => 'required',
                    ]);
                    $appointment = new Appointment;
                    $appointment->name = $request->name;
                    $appointment->email = $request->email;
                    $appointment->date = $request->date;
                    $appointment->phone = $request->phone;
                    $appointment->message = $request->message;
                    $appointment->doctor = $request->doctor;
                    $appointment->user_id = Auth::user()->id;
                    $appointment->save();

                    return redirect('home')->with([
                        'message' => 'Appointment created successfully',
                        'status' => 'success'
                    ]);
                }
                else
                    return redirect()->back();
            }
            else
            {
                return redirect()->back()->with([
                    'message' => 'You must be logged in to make your appointment',
                    'status' => 'danger'
                ]);
            }
        }
        else
            return redirect()->back();
    }

    public function showUserAppointments()
    {
        if(Auth::id())
        {
            if (Auth::user()->usertype == 0)
            {
                $user_id = Auth::user()->id;
                $userAppointments = Appointment::where('user_id', $user_id)->get();

                return view('user.show_appointments', compact('userAppointments'));
            }
            else
                return redirect()->back();
        }
    }

    public function deleteAppointment($id)
    {
        if(Auth::id())
        {
            if (Auth::user()->usertype == 0)
            {
                $appointment = Appointment::find($id);
                $appointment->delete();

                return redirect()->back()->with([
                    'message' => 'Appointment deleted successfully',
                    'status' => 'danger'
                ]);
            }
            else
                return redirect()->back();
        }
    }
}
