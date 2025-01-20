<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifikasi extends Component
{
    public $showDropdown = false;
    public $notifications = [];

    public function mount()
    {
        // Load notifications, replace with your logic.
        $this->notifications = [
            ['message' => 'Notification 1', 'read' => false],
            ['message' => 'Notification 2', 'read' => false],
        ];
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function markAsRead()
    {
        foreach ($this->notifications as &$notification) {
            $notification['read'] = true;
        }
    }

    public function render()
    {
        return view('livewire.notifikasi');
    }
}
