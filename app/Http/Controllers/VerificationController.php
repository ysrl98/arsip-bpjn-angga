<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($hash)
    {
        // Cari dokumen berdasarkan hash
        $archive = Archive::where('file_hash', $hash)->with('user')->first();

        return view('verify', [
            'archive' => $archive,
            'hash' => $hash
        ]);
    }
}
