<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HobbyTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HobbyController extends Controller
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
            'hobbies.*' => 'required|string',
            'hobby_icons.*' => 'required|string',
        ]);
        // dd($request->all());


                // حفظ الترجمات للهواية
                foreach ($request->hobbies as $index => $hobbyName) {
                    HobbyTranslation::create([
                        'user_id' => Auth::id(),
                        'hobbies' => $hobbyName,
                        'icon' => $request->hobby_icons[$index],
                    ]);
                }
                // dd("done");
                return redirect()->back()->with('success', 'تم حفظ الهوايات بنجاح!');

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
