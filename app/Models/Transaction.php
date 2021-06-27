<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    const TYPE_INCOME  = 'income';
    const TYPE_EXPENSE = 'expense';

    const TYPES
        = [
            self::TYPE_INCOME  => 1,
            self::TYPE_EXPENSE => 2,
        ];

    protected $fillable = ['amount', 'author_id', 'title', 'type'];

    /**
     * Get the user who made the transaction
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @param $value
     * @return false|int|string
     */
    public function getTypeAttribute($value)
    {
        return array_search($value, self::TYPES);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = self::TYPES[$value];
    }
}
