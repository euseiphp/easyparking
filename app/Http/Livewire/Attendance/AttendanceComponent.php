<?php

namespace App\Http\Livewire\Attendance;

use App\Http\Livewire\Traits\SweetAlert;
use App\Http\Livewire\Traits\Table;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class AttendanceComponent extends Component
{
    use Table;
    use SweetAlert;

    public User $user;

    public function mount()
    {
        $this->user = user();
    }

    public function render()
    {
        $attendances = $this->data();

        return view('livewire.attendance.attendance-component', [
            'attendances' => $attendances,
        ]);
    }

    private function data(): LengthAwarePaginator
    {
        return $this->user
            ->attendance()
            ->with([
                'car',
                'parking',
                'service',
            ])
            ->orderBy($this->sort, $this->direction)
            ->latest('id')
            ->paginate($this->quantity);
    }
}
