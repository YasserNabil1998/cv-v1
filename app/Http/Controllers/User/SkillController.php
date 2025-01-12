<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SkillController extends Controller
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
        // التحقق من المدخلات
        $request->validate([
            'skill_ar' => 'required|array',
            'skill_ar.*' => 'required|string|max:255', // تحقق من الحقل الخاص بالمهارات بالعربية
            'skill_en' => 'required|array',
            'skill_en.*' => 'required|string|max:255', // تحقق من الحقل الخاص بالمهارات بالإنجليزية
            'level_ar' => 'required|array',
            'level_ar.*' => 'required|string|max:255', // تحقق من مستوى المهارة بالعربية
            'level_en' => 'required|array',
            'level_en.*' => 'required|string|max:255', // تحقق من مستوى المهارة بالإنجليزية
        ]);

        // استخراج البيانات من الطلب
        $skillArs = $request->input('skill_ar');
        $skillEns = $request->input('skill_en');
        $levelArs = $request->input('level_ar');
        $levelEns = $request->input('level_en');
        $userId = Auth::id(); // افتراض أن المستخدم مسجل دخوله

        // إضافة المهارات إلى قاعدة البيانات
        foreach ($skillArs as $index => $skillAr) {
            Skill::create([
                'user_id' => $userId,
                'skill_ar' => $skillAr,
                'skill_en' => $skillEns[$index],
                'level_ar' => $levelArs[$index],
                'level_en' => $levelEns[$index],
            ]);
        }

        // dd('done !');

        // إعادة توجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم إضافة المهارات بنجاح!');
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
