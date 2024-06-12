<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
// class OrderItem extends \TCG\Voyager\Models\User

{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'imdbID',
        'Poster',
        'Title',
        'Type',
        'Year',
        'Price',
        'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
