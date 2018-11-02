<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookdetail extends Model
{
    /**
	 * 書籍詳細と紐づく書籍レコードを取得
     */
    public function book()
    {
    	return $this->belongsTo('\App\Book');
    }
}
