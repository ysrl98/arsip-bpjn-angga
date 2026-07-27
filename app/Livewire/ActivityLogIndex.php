<?php

namespace App\Livewire;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogIndex extends Component
{
    use WithPagination;

    public function mount()
    {
        // Proteksi Keras: Hanya Admin dan Pimpinan yang boleh lihat
        if (!in_array(auth()->user()->role, ['admin', 'pimpinan'])) {
            abort(403);
        }
    }

    public function render()
    {
        return view('livewire.activity-log-index', [
            'logs' => ActivityLog::with('user')->latest()->paginate(20)
        ])->layout('layouts.app');
    }
}