<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	use SoftDeletes;

	public function getKanaAttribute(string $value): string
	{
		// kanaカラムの値を半角カナに変換
		return mb_convert_kana($value, "k");
	}

	public function setKanaAttribute(string $value): string
	{
		// kanaカラムの値を全角カナに変換
		$this->attributes['kana'] = mb_convert_kana($value, "KV");
	}
}
