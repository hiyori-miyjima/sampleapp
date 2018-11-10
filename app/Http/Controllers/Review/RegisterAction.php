<?php
declare(strict_types=1);

namespace App\Http\Controllers\Review;

use App\DataProvider\RegisterReviewProviderInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterAction extends Controller
{
	private $provider;

	// データベース登録とEvent発火を行うクラスのインスタンスが渡される
	public function __construct(
		RegisterReviewProviderInterface $provider
	) {
		$this->provider = $provider;
	}

	public function __invoke(Request $request): Response
	{
		// 登録処理を実行する
		$this->provider->registerReview(
			$request->get('title'),
			$request->get('content'),
			$request->get('user_id', 1),
			Carbon::now()->toDateTimeString(),
			$request->get('tags')
		);
		//POSTで動作するため、登録完了後HTTP Statusのみを返却する
		return response('', Response::HTTP_OK);
	}
}