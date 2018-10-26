<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function register(Request $request)
	{
		// [name]のバリデーションルールに[ascii_alpha]を追加
		$rules = [
			'name' 	=> ['required', 'max:20', 'ascii_alpha'],
			'email' => ['required', 'email', 'max:255'], 
		];

		$inputs = $request->all();

		// バリデーションルールに[ascii_alpha]を追加
		Validator::extend('ascii_alpha', function($attribute, $value, $parameters) {
			// 半角のアルファベットならバリデーションOKとする
			return preg_match('/^[a-zA-Z]+$/', $value);
		});

		$validator = Validator::make($inputs, $rules);

		if ($validator->fails()){
			// ここにバリデーションエラーの場合の処理
		}

		// バリデーション通過後の処理
		$name = $request->input('name');
		$age = $request->input('age');
	}
}