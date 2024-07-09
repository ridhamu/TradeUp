<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Bookmark extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'bookmarks';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['user_id', 'product_id'];

    /**
     * Get the user who bookmarked this product.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the product that was bookmarked.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
