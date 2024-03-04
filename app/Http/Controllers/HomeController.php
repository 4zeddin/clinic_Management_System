<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use function Pest\Laravel\delete;

class HomeController extends Controller
{
    public function redirect()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the authenticated user is a regular user
            if (Auth::user()->userType == '0') {
                $doctors = Doctor::all();
                return view('user.home', compact('doctors'));
            }
            // Check if the authenticated user is a doctor
            elseif (Auth::guard('doctor')->check()) {
                $doctor = Auth::guard('doctor')->user();
                return view('doctor.home', compact('doctor'));
            }
            // If the user is not a regular user or a doctor, assume they are an admin
            else {
                return view('admin.my_appointments');
            }
        } else {
            // Redirect back if the user is not authenticated
            return redirect()->back();
        }
    }

    public function index()
    {
        $doctors = Doctor::all();
        return view('user.home', compact('doctors'));
    }

    public function StoreAppointments(Request $request){
        $appointments = new Appointment();
        $appointments ->name = $request->input('name');
        $appointments ->email = $request->input('email');
        $appointments ->phone = $request->input('phone');
        $appointments ->date = $request->input('date');
        $appointments->doctor = $request->input('doctor');
        if (Auth::id()){
            $appointments ->user_id = Auth::user()->id;
        }else{
            $appointments ->user_id = null;
        }
        $appointments->message = $request->input('message');
        $appointments->save();

        return redirect()->back()->with('success', 'Appointment Request Successful . We Will contact with you soon');
    }

    public function ShowAppointments(){
        if(Auth::check()){
            $userid = Auth::user()->id;
            $appointments = Appointment::where('user_id', $userid)->get();
            return view('user.my_apointments', compact('appointments'));
        } else {
            return redirect()->back();
        }       
    }

    public function DeleteAppointments($id)
    {
        $data = Appointment::find($id);
        $data->delete();

        return redirect()->back()->with('msg', 'Appointment cancelled.');

    }

}
