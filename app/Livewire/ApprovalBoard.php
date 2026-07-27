<?php

namespace App\Livewire;

use App\Models\Archive;
use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ApprovalBoard extends Component
{
    use WithPagination;

    public function mount()
    {
        if (auth()->user()->role !== 'pimpinan') {
            abort(403, 'Akses khusus Pimpinan.');
        }
    }

    public function approve($id)
    {
        $archive = Archive::find($id);
        if ($archive) {
            $archive->status = 'valid';
            $archive->file_hash = hash('sha256', $archive->id . $archive->nomor_dokumen . time());
            
            // THE MAGIC: Jika ini Kuitansi Pembayaran atau Perjalanan Dinas, Generate SPJ PDF!
            if ($archive->kategori == 'pembayaran' || $archive->kategori == 'perjalanan_dinas') {
                try {
                    // Siapkan QR Code dalam bentuk Base64 agar DomPDF bisa merendernya
                    $verifyUrl = route('arsip.verify', $archive->file_hash);
                    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" . urlencode($verifyUrl);
                    $qrImage = file_get_contents($qrUrl);
                    $qrBase64 = 'data:image/png;base64,' . base64_encode($qrImage);

                    // Tentukan template view berdasarkan kategori
                    $viewTemplate = ($archive->kategori == 'pembayaran') ? 'pdf.kuitansi' : 'pdf.perjalanan_dinas';

                    // Render PDF dengan base64 QR Code
                    $pdf = Pdf::loadView($viewTemplate, [
                        'archive' => $archive,
                        'qrBase64' => $qrBase64
                    ])->setOptions(['isRemoteEnabled' => true]);
                    
                    $pdfFileName = 'doc_generated_' . $archive->id . '_' . time() . '.pdf';
                    $pdfPath = 'arsip/' . $archive->kategori . '/' . $pdfFileName;
                    
                    // Simpan PDF ke storage public
                    Storage::disk('public')->put($pdfPath, $pdf->output());
                    
                    // Timpa file utama dengan PDF resmi yang baru digenerate
                    $archive->file_path = $pdfPath;
                } catch (\Exception $e) {
                    // Abaikan jika gagal, tetap gunakan file asli
                }
            }

            $archive->save();

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'APPROVE',
                'description' => 'Mengesahkan dan men-generate dokumen: ' . $archive->nama_dokumen,
                'ip_address' => request()->ip()
            ]);

            session()->flash('message', 'Dokumen berhasil disahkan dan SPJ Kuitansi resmi telah dibuat otomatis!');
        }
    }

    public function reject($id)
    {
        $archive = Archive::find($id);
        if ($archive) {
            $archive->update(['status' => 'rejected']);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'TOLAK',
                'description' => 'Pimpinan menolak dokumen ID: ' . $id,
                'ip_address' => request()->ip()
            ]);

            session()->flash('message', 'Dokumen dikembalikan / ditolak.');
        }
    }

    public function render()
    {
        $archives = Archive::where('status', 'pending')
                    ->orWhereNull('status')
                    ->with('user')
                    ->latest()
                    ->paginate(10);

        return view('livewire.approval-board', [
            'archives' => $archives
        ])->layout('layouts.app');
    }
}
