<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
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
        $validated = $request->validate([
            'course-name_ar.*' => 'required|string',
            'course-name_en.*' => 'required|string',
            'institute_ar.*' => 'required|string',
            'institute_en.*' => 'required|string',
            'course-date.*' => 'required|date',
            'course-description_ar.*' => 'required|string',
            'course-description_en.*' => 'required|string',
        ]);

        // dd($request->all());


        foreach ($request->input('course-name_ar') as $key => $value) {
            Course::create([
                'course_name_ar' => $request->input('course-name_ar')[$key],
                'course_name_en' => $request->input('course-name_en')[$key],
                'institute_ar' => $request->input('institute_ar')[$key],
                'institute_en' => $request->input('institute_en')[$key],
                'course_date' => $request->input('course-date')[$key],
                'course_description_ar' => $request->input('course-description_ar')[$key],
                'course_description_en' => $request->input('course-description_en')[$key],
                'user_id' => Auth::id(), // تعيين user_id للمستخدم الحالي
            ]);
        }

        // dd('done');

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
