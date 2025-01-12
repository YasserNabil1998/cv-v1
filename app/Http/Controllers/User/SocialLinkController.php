<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialLinkController extends Controller
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
                    'social_network.*' => 'required|string', // التحقق من أن الشبكة موجودة
                    'social_link.*' => 'required|url',        // التحقق من أن الرابط هو رابط صالح
                ]);

                    // dd($request->all());
                // حفظ الروابط في قاعدة البيانات
                foreach ($request->social_network as $index => $network) {
                    SocialLink::create([
                        'user_id' => Auth::id(), // استخدام معرف المستخدم الحالي
                        'network' => $network,    // الشبكة
                        'link' => $request->social_link[$index], // الرابط
                    ]);
                }

                // dd('done');

                return back()->with('success', 'تم إضافة الروابط بنجاح!');

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
