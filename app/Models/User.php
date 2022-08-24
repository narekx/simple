<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'bio',
        'profile_photo',
        'status',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services ()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city ()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute ()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @param null $id
     * @return array
     */
    public function rules ($id = null)
    {
        return [
            'first_name'   => 'required|max:50|min:2',
            'last_name'   => 'required|max:50|min:2',
            'email' => [
                'required',
                'max:50',
                'min:2',
                Rule::unique('users')->ignore($id)
            ],
            'phone' => 'required|regex:/^0[0-9]{8}$/',
            'bio' => 'max:255|min:2',
//            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png',
            'city_id' => 'required|integer',
            'address' => 'required|max:50'
        ];
    }

    /**
     * @return string
     */
    public function imagePath ()
    {
        return 'uploads' . DIRECTORY_SEPARATOR . 'users';
    }

    /**
     * @return string
     */
    public function getImagePathAttribute ()
    {
        if ($this->profile_photo) {
            return 'uploads/users/' . $this->profile_photo;
        }

        return 'static/img/home/services/service-1.png';
    }

    /**
     * @return string
     */
    public function getFullAddressAttribute ()
    {
        if (isset($this->city) && $this->city && $this->address) {
            return 'ք․ ' . $this->city->name . ' ' . $this->address;
        }

        return ' ';
    }
}
