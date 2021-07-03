<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Permission
 * @package App\Models
 *
 * @property $id
 * @property $name
 * @property-read Role[]|null $roles
 */
class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function roles(): BelongsToMany
    {
        $this->belongsToMany(Role::class);
    }
}
