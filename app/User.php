<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Setting;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public function source()
    {
        return $this->hasOne('App\Source');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
        'active', 'activation_token', 'activation_token_created_at', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeByActivationColumns(Builder $builder, $email, $token)
    {
        return $builder->where('email', $email)->where('activation_token', $token);
    }

    public function scopeByEmail(Builder $builder, $email)
    {
        return $builder->where('email', $email);
    }

    public function isActivationLinkExpired()
    {
        $dueDate = Carbon::now();
        $dueDate->subMinutes(Setting::get('activation_timeout_minutes', 30));

        if ($this->activation_token_created_at < $dueDate) {
            return true;
        }

        return false;
    }
}