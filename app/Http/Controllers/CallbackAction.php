<?php
declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthManager;
use Laravel\Socialite\Contracts\Factory;

final class CallbackAction extends Controller
{
	public function __invoke(
		Factory $factory,
		AuthManager $authManager
	){
		$user = $factory->driver('github')->user();

		$authManager->guard()->login(
			User::firstOrCreate([
				'name'	=> $user->getName(),
				'email'	=> $user->getEmail(),
				'password'	=> '',
			]),
			true
		);
		return redirect('/home');
	}
}