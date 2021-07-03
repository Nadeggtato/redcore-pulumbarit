<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role
 * @package App\Models
 *
 * @property string $name
 * @property string $description
 * @property string $guard_name
 */

class Role extends SpatieRole
{
    use HasFactory;

    const SUPER_ADMIN = 'Super Admin';
}
