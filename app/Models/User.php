<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
	
	/**
	 * Get the projects assigned to user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function projects(): HasMany
	{
		return $this->hasMany(Project::class);
	}
	
	/**
	 * Get the tasks assigned to user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tasks(): HasMany
	{
		return $this->hasMany(Task::class);
	}
	
	/**
	 * Get the user's meetings
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function meetings(): HasMany
	{
		return $this->hasMany(Meeting::class);
	}
	
	/**
	 * Get the documents uploaded by the user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function documents(): HasMany
	{
		return $this->hasMany(Document::class);
	}
}
