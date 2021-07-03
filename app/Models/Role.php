<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $guard_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Role extends SpatieRole
{
    use HasFactory;

    const SUPER_ADMIN = 'Super Admin';
}
