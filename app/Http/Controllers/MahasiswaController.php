<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('nim')->paginate(10);
        return view('mahasiswa.index', compact('mahasiswa'));
    }
}
