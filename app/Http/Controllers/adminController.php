<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Notifications\SendEmailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class adminController extends Controller
{
    public function addDoctor()
    {
        return view('admin.add_doctor');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'specialty' => 'required',
            'room_number' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $doctor = new Doctor();
        $image = $request->image;
        $imageName = time().'.'.$image->getClientoriginalExtension();

        $request->image->move('doctor_image', $imageName);
        $doctor->image = $imageName;
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->specialty = $request->specialty;
        $doctor->room = $request->room_number;
        $doctor->save();

        return redirect('show_doctors')->with(
            [
                'message'=> 'Doctor added successfully',
                'status' => 'success'
            ]
        );
    }

    public function showAppointments()
    {
        $appointment = Appointment::all();

        return  view('admin.show_appointments', compact('appointment'));
    }

    public function approveAppointment($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = 'Approved';
        $appointment->save();

        return redirect()->back()->with(
        [
            'message'=> 'Appointment approved successfully',
            'status' => 'success'
        ]
    );
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = 'Canceled';
        $appointment->save();

        return redirect()->back()->with(
            [
                'message'=> 'Appointment canceled successfully',
                'status' => 'danger'
            ]
        );
    }

    public function showDoctors()
    {
        $doctors = Doctor::all();
        return view('admin.showdoctors', compact('doctors'));
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();

        return redirect()->back()->with(
            [
                'message'=> 'Doctor deleted successfully',
                'status' => 'danger'
            ]
    );
    }

    public function editDoctorView($id)
    {
        $doctor = Doctor::find($id);

        return view('admin.update_doctor', compact('doctor'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if($request->image)
        {
            $image = $request->image;
            $imageName = time() . '.' . $image->getClientoriginalExtension();
            $request->image->move('doctor_image', $imageName);
            $doctor->image = $imageName;
        }
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->specialty = $request->specialty;
        $doctor->room = $request->room_number;
        $doctor->save();

        return redirect('show_doctors')->with
        (
            [
                'message'=> 'Doctor updated successfully',
                'status' => 'success'
            ]
        );
    }

    public function emailView($id)
    {
        $data = Appointment::find($id);

        return view('admin.email_view', compact('data'));
    }

    public function sendEmail(Request $request, $id)
    {
        $data = Appointment::find($id);
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actionText' => $request->action_text,
            'actionUrl' => $request->action_url,
            'endPart' => $request->end_part,
        ];

        Notification::send($data,new SendEmailNotify($details));

        return redirect()->back()->with(
        [
            'message'=> 'Email send successfully',
            'status' => 'success'
        ]
    );
    }
}
