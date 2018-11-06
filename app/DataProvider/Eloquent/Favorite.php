<?php
declare(strict_types=1);

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
    	'book_id',
    	'user_id',
    	'created_at'
    ];
}
