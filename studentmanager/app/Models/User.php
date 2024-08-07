<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'dob',
        'phone',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function parents()
    {
        return $this->whereHas(
            $this->roles(),
            function ($mentor) {
                $mentor->where('name', 'ROLE_PARENT');
            }
        )->get();
        // TODO: Create this, both students and parents should be coupled together
    }

    public function mentors()
    {
        return $this->classrooms()->where('mentor_id', $this->id)->get();
        /*   $role = $this->roles()->where('name', 'ROLE_MENTOR')->first();
           if ($role) {
               return $this->roles()->where('name', 'ROLE_MENTOR')->first();
           }
           return false; */
        // TODO: In case of student this will probably coupled with a single mentor, when applied to parents these could be multiple since they can have multiple students
    }
    public function classrooms()
    {
        return $this->belongsToMany(Schoolclass::class)->withTimestamps();
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps(); // PIVOT
    }

    public function hasRole(string $role): bool
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }


    public function hasAnyRole(string|array $roles): bool
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
            return false;
        } else {
            return $this->hasRole($roles);
        }
    }

}
