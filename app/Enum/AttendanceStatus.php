<?php

namespace App\Enum;

enum AttendanceStatus: int
{
    case InProgress = 1;
    case Completed  = 3;

    public function translate()
    {
        return __('app.attendance.status.' . $this->value);
    }

    public function badge()
    {
        return __('app.attendance.badge.' . $this->value);
    }
}
