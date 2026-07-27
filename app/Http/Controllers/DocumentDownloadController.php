<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

class DocumentDownloadController extends Controller
{
    public function download($id)
    {
        $archive = Archive::findOrFail($id);

        // Hanya izinkan jika user adalah admin, pimpinan, atau pengupload
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'pimpinan']) && $user->id !== $archive->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh dokumen ini.');
        }

        $filePath = $archive->file_path;
        
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File fisik tidak ditemukan di server.');
        }

        $absolutePath = storage_path('app/public/' . $filePath);

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'UNDUH',
            'description' => 'Mengunduh file: ' . $archive->nama_dokumen,
            'ip_address' => request()->ip()
        ]);
        
        return response()->download($absolutePath);
    }
}
