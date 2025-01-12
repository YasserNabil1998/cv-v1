<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
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
            'sign_language' => 'required',
            'languages' => 'required|array',
            'languages.*.language_name' => 'required|string',
            'languages.*.proficiency' => 'required|string',
        ]);

                // dd($request->all());
        $validatedData['user_id'] = Auth::id();

         // تخزين البيانات
         foreach ($request->languages as $languageData) {
            Language::create([
                'user_id' => Auth::id(),
                'language_name' => $languageData['language_name'],
                'proficiency' => $languageData['proficiency'],
                'sign_language' => $request->sign_language,
            ]);
        }
            dd("done");
        return back()->with('success', 'تم حفظ اللغة بنجاح.');
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
