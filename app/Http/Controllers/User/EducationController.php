<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
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

    // dd('True');
    $validatedData = $request->validate([
        'institution_ar.*' => 'required|string|max:255',
        'institution_en.*' => 'required|string|max:255',
        'major_ar.*' => 'required|string|max:255',
        'major_en.*' => 'required|string|max:255',
        'degree.*' => 'required|string',
        'graduation-date.*' => 'required|date',
        'description_ar.*' => 'required|string',
        'description_en.*' => 'required|string',
    ]);

    // dd($request->all());

    $userId =  Auth::user()->id; // الحصول على معرف المستخدم الحالي

    foreach ($request->institution_ar as $index => $institutionAr) {
        Education::create([
            'user_id' => $userId,
            'institution_ar' => $institutionAr,
            'institution_en' => $request->institution_en[$index],
            'major_ar' => $request->major_ar[$index],
            'major_en' => $request->major_en[$index],
            'degree' => $request->degree[$index],
            'graduation_date' => $request->{'graduation-date'}[$index],
            'description_ar' => $request->description_ar[$index],
            'description_en' => $request->description_en[$index],
        ]);
    }
    // dd('True');

    return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح!');
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
