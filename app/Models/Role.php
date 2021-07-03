<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Role
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property-read User[]|null $users
 * @property-read Permission[]|null $permissions
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $with = [
        'permissions',
    ];

    public function users(): HasMany
    {
        $this->hasMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        $this->belongsToMany(Permission::class);
    }
}
