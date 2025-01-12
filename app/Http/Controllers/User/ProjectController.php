<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
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

        $request->validate([
            'projects.*.project_name_ar' => 'required|string|max:255',
            'projects.*.project_name_en' => 'required|string|max:255',
            'projects.*.project_link' => 'required|url',
            'projects.*.project_date' => 'required|date',
            'projects.*.project_desc_ar' => 'required|string',
            'projects.*.project_desc_en' => 'required|string',
        ]);

        // dd($request->projects);

        // إضافة المشاريع الجديدة
        foreach ($request->projects as $projectData) {
            Project::create([
                'project_name_ar' => $projectData['project_name_ar'],
                'project_name_en' => $projectData['project_name_en'],
                'project_link' => $projectData['project_link'],
                'project_date' => $projectData['project_date'],
                'project_desc_ar' => $projectData['project_desc_ar'],
                'project_desc_en' => $projectData['project_desc_en'],
                'user_id' => Auth::id(), // ربط المشروع بالمستخدم
            ]);
        }
        // dd('True');

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
