<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function isProductAdmin()
    {

        $roleId = UserHasRole::where('user_id', '=', $this->id)->pluck('role_id')->toArray();
        if (count($roleId)) {
            $permission = RoleHasPermission::join('permissions', 'role_has_permissions.permission_id', 'permissions.id')->where('role_has_permissions.role_id', $roleId[0])->get()->toArray();
            if (count($permission)) {
                if ($permission[0]['name'] == 'Product Admin') {
                    return true;
                }
            }
        }
        return false;
    }
}
