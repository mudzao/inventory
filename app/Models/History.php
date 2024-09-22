<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['item_id', 'change', 'quantity', 'stock_at_change', 'description'];

    /**
     * The history record belongs to an item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
