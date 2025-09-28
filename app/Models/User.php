<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Атрибуты, доступные для массового заполнения (mass assignment)
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Атрибуты, скрытые при сериализации (например в JSON)
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Атрибуты, которые нужно кастить к определённому типу
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // дата подтверждения email
        'password' => 'hashed', // хэширование пароля автоматически
    ];

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isModerator(): bool
    {
        return $this->role_id === 1; // только админ (модератор) имеет права
    }

    public function isReader(): bool
    {
        return $this->role_id === 2; // все остальные — читатели
    }

}
