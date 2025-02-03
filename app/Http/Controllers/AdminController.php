<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Models\VacationRequest;
use App\Notifications\SendEmailNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use Livewire\Attributes\Validate;

class AdminController extends Controller
{

    public function store(Request $request)
    {

        $validData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'speciality' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('doctorImage', $imageName);
        }

        $doctor = new Doctor();
        $doctor->name = $request->input('name');
        $doctor->phone = $request->input('phone');
        $doctor->email = $request->input('email');
        $doctor->password = $request->input('password');
        $doctor->speciality = $request->input('speciality');
        $doctor->image = $imageName;
        $doctor->save();

        return redirect()->back()->with('success', 'Doctor created successfully!');
    }

    public function showdoctors()
    {
        $doctors = Doctor::all();
        return view('admin.doctors', compact('doctors'));
    }

    public function deleteDoctors($id)
    {
        $data = Doctor::find($id);

        if ($data) {
            $data->delete();

            return redirect()->route('show.doctors')->with('msg', 'Deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Doctor not found.');
        }
    }

    public function editDoctors($id)
    {
        $data = Doctor::find($id);

        return view('admin.updateDoc', compact('data'));
    }

    public function updateDoctors(Request $request, $id)
    {

        $doctor = Doctor::find($id);

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->speciality = $request->speciality;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('doctorImage', $imageName);
            $doctor->image = $imageName;
        }
        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor information updated successfully!');
    }

    //  --------------------------------------  appointments funcs -------------------------------------------

    public function showAppointments()
    {
        $appointments = Appointment::all();
        return view('admin.my_appointment', compact('appointments'));
    }


    public function approved($id)
    {
        $data = Appointment::find($id);

        if ($data) {
            $data->status = "approved";
            $data->save();

            return redirect()->route('showappointments')->with('msg', 'Canceled successfully!');
        } else {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
    }

    public function canceled($id)
    {
        $data = Appointment::find($id);

        if ($data) {
            $data->status = "canceled";
            $data->save();

            return redirect()->route('showappointments')->with('success', 'Canceled successfully!');
        } else {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
    }

    public function notify($id)
    {
        $data = Appointment::find($id);
        return view('admin.sendEmail', compact('data'));
    }

    public function sendEmail(Request $request, $id)
    {
        $data = Appointment::find($id);
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
        ];
        Notification::send($data, new SendEmailNotif($details));
        return redirect()->route('appointments.index')->with('success', 'Email Sent successfully!');
    }

    // vacation

    public function viewVacationRequests()
    {
        $requests = VacationRequest::with('doctor')->get();
        return view('admin.vacations', compact('requests'));
    }

    public function approveRequest($id)
    {
        $request = VacationRequest::find($id);
        if ($request) {
            $request->status = 'approved';
            $request->save();
            return redirect()->back()->with('success', 'Request approved successfully.');
        }
        return redirect()->back()->with('error', 'Request not found.');
    }

    public function rejectRequest($id)
    {
        $request = VacationRequest::find($id);
        if ($request) {
            $request->status = 'rejected';
            $request->save();
            return redirect()->back()->with('success', 'Request rejected successfully.');
        }
        return redirect()->back()->with('error', 'Request not found.');
    }
}
