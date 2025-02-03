<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function redirect()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the authenticated user is a regular user or admin
            if ($user->userType === '1') {
                $users = User::orderBy('created_at', 'desc')->take(5)->get();
                $appointments = Appointment::orderBy('created_at', 'desc')->take(5)->get();
                return view('admin.dash', compact('users', 'appointments'));
            } elseif ($user->userType === '0') {
                $pickedDates = Appointment::pluck('date')->toArray();
                $doctors = Doctor::all();
                return view('user.home', compact('doctors', 'pickedDates'));
            } else {
                return redirect()->back()->withErrors('Unauthorized access.');
            }
        }

        // Check if the authenticated user is a Doctor
        $doctor = Doctor::where('email', Auth::user()->email)->first();
        if ($doctor) {
            return redirect()->route('doctor.home');
        }

        return redirect()->back();
    }

    public function index()
    {
        $doctors = Doctor::all();
        return view('user.home', compact('doctors'));
    }

    public function indexAppointment()
    {
        $pickedDates = Appointment::where('date', '>=', now()->toDateString())->pluck('date')->toArray();
        $doctors = Doctor::all();
        return view('user.appointment', compact('pickedDates', 'doctors'));
    }

    public function StoreAppointments(StoreAppointmentRequest $request)
    {
        try {
            Appointment::create($request->validated());

            return redirect()->route('appointments.index')
                ->with('success', 'Appointment requested successfully. We will contact you soon.');
        } catch (\Exception $e) {
            Log::error('Error storing appointment: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function ShowAppointments()
    {
        if (Auth::check()) {
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
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Appointment cancelled.');
        }
        return redirect()->back()->with('error', 'Appointment Not Found.');
    }
}
