<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Registration;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::unarchived()->get();
        $fee = Fee::first();
        return view('index', compact('registrations', 'fee'));
    }

    public function registration(string $slug, $academicYear)
    {
        $registration = Registration::unarchived()
            ->where('academic_year', str_replace('-', '/', $academicYear))
            ->where('slug', $slug)
            ->firstOrFail();

        // Cek apakah pendaftaran ditutup
        if (!$registration->is_open) {
            return view('registration-closed', compact('registration'));
        }

        return view('registration', compact('registration'));
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
        //
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
