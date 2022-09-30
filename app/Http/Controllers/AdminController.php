<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\doctor;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    //returns add new doctor view
    public function addDoctorView()
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
                return view('admin.Doctors.add_doctor');
            else
                return redirect()->back();
        }
        else
            return redirect('home');
    }

    //adds new doctor to db
    public function addDoctor(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'room' => 'required',
                'speciality' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $doctor = new doctor;
            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('doctorimage', $imageName);
            $doctor->image = $imageName;
            $doctor->name = $request->name;
            $doctor->phone = $request->phone;
            $doctor->speciality = $request->speciality;
            $doctor->room = $request->room;
            $doctor->save();

            return redirect()->back()->with([
                'message' => 'Doctor added successfully',
                'status' => 'success'
            ]);
        }
        else
            return redirect()->back();
    }

    //returns doctors info view
    public function showDoctorsView()
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
            {
                $doctors = doctor::all();

                return view('admin.Doctors.show_doctors', compact('doctors'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect()->back();
    }

    //returns update doctor view
    public function updateDoctorView($id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1)
            {
                $doctor = doctor::find($id);

                return view('admin.Doctors.update_doctor', compact('doctor'));
            }
            else
                return redirect()->back();
        } else
            return redirect()->back();
    }

    //update doctor info
    public function updateDoctor(Request $request, $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $doctor = doctor::find($id);
            if ($request->image)
            {
                $image = $request->image;
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('doctorimage', $imageName);
                $doctor->image = $imageName;
            }
            $doctor->name = $request->name;
            $doctor->phone = $request->phone;
            $doctor->speciality = $request->speciality;
            $doctor->room = $request->room;
            $doctor->save();

            return redirect('show_doctors_view')->with([
                'message' => 'Doctor updated successfully',
                'status' => 'success'
            ]);
        }
        else
            return redirect()->back();
    }

    //delete doctor
    public function deleteDoctor($id)
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
            {
                $doctor = doctor::find($id);
                $doctor->delete();

                return redirect('show_doctors_view')->with([
                    'message' => 'Doctor deleted successfully',
                    'status' => 'danger'
                ]);
            }
            else
                return redirect()->back();
        }
        else
            return redirect()->back();
    }

    public function showAppointments()
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1) {
                $appointments = Appointment::all();

                return view('admin.appointments', compact('appointments'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function approveAppointment($id)
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
            {
                $appointment = Appointment::find($id);
                $appointment->status = 'Approved';
                $appointment->save();

                return redirect()->back()->with([
                    'message' => 'Appointment approved successfully',
                    'status' => 'success'
                ]);
            }
        }
        else
            return redirect()->back();
    }

    public function cancelAppointment($id)
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
            {
                $appointment = Appointment::find($id);
                $appointment->status = 'Canceled';
                $appointment->save();

                return redirect()->back()->with([
                    'message' => 'Appointment canceled successfully',
                    'status' => 'danger'
                ]);
            }
        }
        else
            return redirect()->back();
    }

    public function deleteAppointment($id)
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
            {
                $appointment = Appointment::find($id);
                $appointment->delete();

                return redirect()->back()->with([
                    'message' => 'Appointment deleted successfully',
                    'status' => 'danger'
                ]);
            }
        }
        else
            return redirect()->back();
    }

    public function sendEmailView($id)
    {
        if (Auth::id())
        {
            if (Auth::user()->usertype == 1)
            {
                $appoint = Appointment::find($id);
                return view('admin.email_view', compact('appoint'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect()->back();
    }

    public function sendEmail(Request $request, $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $appoint = Appointment::find($id);
            $details = [
                'greeting' => $request->greeting,
                'body' => $request->body,
                'action_text' => $request->action_text,
                'action_url' => $request->action_url,
                'end_part' => $request->end_part,
            ];

            Notification::send($appoint, new SendEmailNotification($details));

            return redirect()->back()->with([
                'message' => 'email notify sent successfully',
                'status' => 'success'
            ]);
        }
        else
            return redirect()->back();
    }
}
