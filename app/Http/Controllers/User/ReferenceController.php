<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenceController extends Controller
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
            'references.*.name_ar' => 'required|string|max:255',
            'references.*.name_en' => 'required|string|max:255',
            'references.*.email' => 'required|email',
            'references.*.bio_ar' => 'required|string',
            'references.*.bio_en' => 'required|string',
        ]);
        // dd($request->all());
        foreach ($validatedData['references'] as $reference) {
            Reference::create([
                'user_id' => Auth::id(),
                'name_ar' => $reference['name_ar'],
                'name_en' => $reference['name_en'],
                'email' => $reference['email'],
                'phone' => $reference['phone'] ?? null,
                'bio_ar' => $reference['bio_ar'],
                'bio_en' => $reference['bio_en'],
            ]);
        }
        // dd("done");
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
