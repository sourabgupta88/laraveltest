<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'userid';

    const CREATED_AT = 'createdOn';
    const UPDATED_AT = 'modifiedOn';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * API save the token for the user
     */

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($model) {
            $model->api_token = Str::random(80);
        });

    }

    public static $createRules = [
        'name' => 'required',
        'email' => 'required|unique:user',
        'password' => 'required|min:8|confirmed',
    ];

    public static $updateRules = [
        'name' => 'required',
        'role_id' => 'required|numeric'
    ];

    public function isAdmin()
    {
        return (!empty($this->role_id) && $this->role_id === 2) ? true : false;
    }
}
