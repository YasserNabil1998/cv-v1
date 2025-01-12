<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'company_ar.*' => 'required|string',
                'company_en.*' => 'required|string',
                'job_title_ar.*' => 'required|string',
                'job_title_en.*' => 'required|string',
                'join_date.*' => 'required|date',
                'leave_date.*' => 'nullable|date',
                'description_ar.*' => 'nullable|string',
                'description_en.*' => 'nullable|string',
                'company_logo.*' => 'nullable|image',
            ]);

            // dd($request->all());

            $user_id = Auth::id();

            foreach ($request->company_ar as $index => $value) {
                $experienceData = [
                    'user_id' => $user_id,
                    'company_ar' => $validatedData['company_ar'][$index],
                    'company_en' => $validatedData['company_en'][$index],
                    'job_title_ar' => $validatedData['job_title_ar'][$index],
                    'job_title_en' => $validatedData['job_title_en'][$index],
                    'join_date' => $validatedData['join_date'][$index],
                    'leave_date' => $validatedData['leave_date'][$index] ?? null,
                    'description_ar' => $validatedData['description_ar'][$index] ?? null,
                    'description_en' => $validatedData['description_en'][$index] ?? null,
                ];
                // حفظ شعار الشركة إذا تم رفعه
                if (isset($request->file('company_logo')[$index])) {
                    $experienceData['company_logo'] = $request->file('company_logo')[$index]->store('company_logos', 'public');
                }
                Experience::create($experienceData);
            }
            // dd($experienceData);
            return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
