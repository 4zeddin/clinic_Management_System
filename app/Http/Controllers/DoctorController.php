<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\Doctor;
use App\Models\VacationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class DoctorController extends Controller
{
    public function showDoctor(){

    }

    public function index()
    {
        $doctor = Auth::guard('doctor')->user();
        return view('doctor.home', compact('doctor'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $doctor = Doctor::where('email', $request->email)->first();

        if ($doctor && $request->password === $doctor->password) { // Plain text comparison
            Auth::guard('doctor')->login($doctor); // Use guard to specify the model if needed
            return redirect()->route('doctor.profile');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records, this form is only for doctors.',
        ]);
    }

    //appointments
    public function AllAppointments()
    {
        $doctor = Auth::guard('doctor')->user();
        $dname = $doctor->name;
        $appointments = Appointment::where('doctor', $dname)->get();
        return view('doctor.appointments', compact('appointments', 'doctor'));
    }


    public function approved($id)
    {
        $data = appointment::find($id);

        if ($data) {
            $data->status = "approved";
            $data->save();

            return redirect()->route('doctor.appointments')->with('msg', 'Canceled successfully!');
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

            return redirect()->route('doctor.appointments')->with('msg', 'Canceled successfully!');
        } else {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
    }

    //vacation
    public function showVacationForm()
    {
        $doctor = Auth::guard('doctor')->user();
        $req = VacationRequest::where('doctor_id', $doctor->id)->get();
        return view('doctor.vacation', compact('doctor', 'req'));
    }

    public function submitVacationRequest(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        VacationRequest::create([
            'doctor_id' => Auth::guard('doctor')->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending', // Default status
        ]);

        return redirect()->back()->with('success', 'Vacation request submitted successfully.');
    }

    public function viewVacationRequests()
    {
        $doctor = Auth::guard('doctor')->user();
        $requests = VacationRequest::where('doctor_id', $doctor->id)->get();
        return view('doctor.view_vacations', compact('requests','doctor'));
    }

    //profile

    public function profile()
    {
        $doctor = Auth::guard('doctor')->user();

        return view('doctor.profile', compact('doctor'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::guard('doctor')->id();
        
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


        return redirect()->route('doctor.profile')->with('success', 'Profile updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
