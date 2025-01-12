<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = UserProfile::all();
        return view('user.pages.newCvs', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.pages.createCv');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profile_picture = $request->file('profile_picture');
        $profilePicturePath = time() . '.' . $profile_picture->getClientOriginalExtension();
        $path = 'images/allImg';
        $request -> profile_picture ->move( $path, $profilePicturePath);

        // إنشاء السجل في قاعدة البيانات
        $status=UserProfile::create([
            'user_id' => Auth::user()->id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'job_title_ar' => $request->job_title_ar,
            'job_title_en' => $request->job_title_en,
            'bio_ar' => $request->bio_ar,
            'bio_en' => $request->bio_en,
            'profile_picture' => $profilePicturePath,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender_ar' => $request->gender_ar,
            'gender_en' => $request->gender_en,
            'marital_status_ar' => $request->marital_status_ar,
            'marital_status_en' => $request->marital_status_en,
            'dob' => $request->dob,
            'personal_link' => $request->personal_link,
            'city_ar' => $request->city_ar,
            'city_en' => $request->city_en,
            'country_ar' => $request->country_ar,
            'country_en' => $request->country_en,
            'nationality_ar' => $request->nationality_ar,
            'nationality_en' => $request->nationality_en,
            'additional_info_ar' => $request->additional_info_ar,
            'additional_info_en' => $request->additional_info_en,
        ]);

        // dd($status);

        // إعادة التوجيه مع رسالة النجاح
        return back()->with('success', 'تم حفظ الملف الشخصي بنجاح!');
    }
        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = UserProfile::findOrFail($id);
        return view('user.pages.showCv', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = UserProfile::findOrFail($id); // جلب الملف الشخصي
        return view('user.pages.editCv', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = UserProfile::findOrFail($id); // جلب الملف الشخصي بناءً على الـ ID

        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            // إضافة تحقق لبقية الحقول حسب الحاجة
        ]);

        // إذا كانت هناك صورة جديدة
        if ($request->hasFile('profile_picture')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($profile->profile_picture) {
                Storage::delete('public/' . $profile->profile_picture);
            }
            // حفظ الصورة الجديدة
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // تحديث الملف الشخصي
        $profile->update($validatedData);

        return back()->with('success', 'تم تحديث الملف الشخصي بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = UserProfile::findOrFail($id); // جلب الملف الشخصي بناءً على الـ ID
        $profile->delete();

        return back()->with('success', 'تم حذف الملف الشخصي بنجاح!');
    }
}
