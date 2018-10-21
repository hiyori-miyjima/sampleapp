<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistPost;     // FormRequestクラスをインポートする

class UserController extends Controller
{
	// 引数でUserRegistPostクラスのインスタンスを渡す
	public function register(UserRegistPost $request)
	{
		// インスタンスに対して値を問い合わせ
		$name = $request->input('name');
		$age = $request->input('age');
	}
}