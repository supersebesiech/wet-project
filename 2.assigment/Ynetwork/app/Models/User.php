<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

//    public function getProfilePictureAttribute()
//    {
//        $id = $this->id;
//
//        $png = public_path("profilePictures/{$id}.png");
//        $jpg = public_path("profilePictures/{$id}.jpg");
//
//        if (File::exists($png)) {
//            return "/profilePictures/{$id}.png";
//        }
//
//        if (File::exists($jpg)) {
//            return "/profilePictures/{$id}.jpg";
//        }
//
//        return "/profilePictures/default.jpg";
//    }

}
