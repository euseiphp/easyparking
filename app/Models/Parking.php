<?php

namespace App\Models;

use App\Enum\Status;
use App\Models\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\Parking
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $name
 * @property string $street
 * @property string $district
 * @property int $number
 * @property string $city
 * @property string $state
 * @property string $postcode
 * @property int $spaces
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ParkingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereSpaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parking wherePostcode($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class Parking extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $casts = [
        'status' => Status::class,
    ];

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function car(): HasManyThrough
    {
        return $this->hasManyThrough(Car::class, Attendance::class);
    }
}
