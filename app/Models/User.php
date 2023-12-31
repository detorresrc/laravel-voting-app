<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'password' => 'hashed',
    ];

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getAvatar(): string
    {
        $firstCharacter = $this->email[0];
        if(is_numeric($firstCharacter))
            $firstCharacter = ord(strtolower($firstCharacter)) - 21;
        else
            $firstCharacter = ord(strtolower($firstCharacter)) - 96;

        return 'https://www.gravatar.com/avatar/' . md5($this->email).'?s=200&d='.urlencode("https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-{$firstCharacter}.png");
    }

    public function votes(): belongsToMany
    {
        return $this->belongsToMany(Idea::class, 'votes');
    }

    public function isAdmin()
    {
        return in_array($this->email, ['detorresrc@gmail.com', 'joana.gutmann@example.org']);
    }
}
