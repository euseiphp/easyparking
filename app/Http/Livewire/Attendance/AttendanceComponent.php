<?php

namespace App\Http\Livewire\Attendance;

use App\Enum\AttendanceStatus;
use App\Http\Livewire\Traits\SweetAlert;
use App\Http\Livewire\Traits\Table;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class AttendanceComponent extends Component
{
    use Table;
    use SweetAlert;

    public User $user;

    public bool $view = false;

    public array $edit = [];

    protected $listeners = [
        'destroy',
    ];

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

    public function append(Attendance $attendance)
    {
        $this->edit = $attendance->toArray();

        $this->view = true;
    }

    public function confirmingBeforeDestroy(int $id)
    {
        return $this->alertBag([
            'event'  => 'destroy',
            'append' => ['selected' => $id],
        ])->confirmAlert();
    }

    public function destroy(array $appended)
    {
        $this->resetExcept('user');

        try {
            DB::transaction(function () use ($appended) {
                $this->user
                    ->attendance()
                    ->find($appended['selected'])
                    ->delete();
            });

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->errorAlert();
    }

    public function finish(int $id)
    {
        $this->resetExcept('user');

        try {
            DB::transaction(function () use ($id) {
                $this->user
                    ->attendance()
                    ->find($id)
                    ->update([
                        'status'      => AttendanceStatus::Completed,
                        'finished_at' => now(),
                    ]);
            });

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->errorAlert();
    }
}
