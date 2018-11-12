<?php
declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\SendOrdersCommand;
use App\UseCases\SendOrdersUseCase;
use Illuminate\Support\ServiceProvider;

class BatchServiceProvider extends ServiceProvider
{
	/**
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(SendOrdersCommand::class, function () {
			$useCase = app(SendOrdersUseCase::class);

			$logger = app('log');
			$logger->useFiles(storage_path().'/logs/send-orders.log');

			$chatwork = app(ChatWorkService::class);
			return new SendOrdersCommand($useCase, $logger, $chatwork);
		});
		$this->app->bind(ChatWorkService::class, function () {
			$config = app(Repository::class);
			$apikey = $config->get('batch.chatwork_api_key');
			$roomId = $config->get('batch.chatwork_room_id');

			return new ChatWorkService($apikey, $roomId, new Client());
		});
	}
}