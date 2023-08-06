<?php

namespace Domain\User;

use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $age
 * @property bool $gender
 * @property bool $is_subscribed
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'age',
        'is_subscribed',
        'gender',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'age' => 'integer',
        'is_subscribed' => 'boolean',
        'gender' => 'boolean',
    ];


    /**
     * Get the user that for current profile.
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Specify user factory.
     */
    protected static function newFactory()
    {
        return ProfileFactory::new();
    }
}
