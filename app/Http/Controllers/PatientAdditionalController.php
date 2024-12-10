<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PatientAdditionalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);  
    }

    public function showAdditionalInfoForm(Request $request, $patient_id = null)
    {
        $patient = null;

        if ($request->has('patient_id') && $request->patient_id) {
            $patient = Patients::where('patient_id', $request->patient_id)->first();
        }

        return view('admin.additional_info', compact('patient'));
    }

    public function updateAdditionalInfo(Request $request, $patient_id)
    {
        $request->validate([
            'admission_date' => 'required|date',
            'group' => 'nullable|string|max:255',
        ]);

        $patient = Patients::where('patient_id', $patient_id)->first();

        if (!$patient) {
            return redirect()->route('admin.additional_info')->with('error', 'Patient not found');
        }

        $patient->admission_date = $request->admission_date;
        $patient->group = $request->group;

        $patient->save();  

        return redirect()->route('admin.additional_info', ['patient_id' => $patient->patient_id])
                         ->with('success', 'Patient information updated successfully!');
    }
}