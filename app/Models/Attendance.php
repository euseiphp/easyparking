<?php

namespace App\Models;

use App\Enum\AttendanceStatus;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Attendance
 *
 * @property int $id
 * @property int $user_id
 * @property int $car_id
 * @property int $parking_id
 * @property int|null $service_id
 * @property string|null $description
 * @property string|null $price
 * @property AttendanceStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $finished_at
 * @method static \Database\Factories\AttendanceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereParkingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Car|null $car
 * @property-read \App\Models\Parking $parking
 * @property-read \App\Models\Service|null $service
 */
class Attendance extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $casts = [
        'status'      => AttendanceStatus::class,
        'price'       => 'decimal:2',
        'finished_at' => 'datetime',
    ];

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
