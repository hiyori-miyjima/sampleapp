<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UseCases\SendOrdersUseCase;
use Carbon\Carbon;

class SendOrdersCommand extends Command
{
    /** @var SendOrdersUseCase */
    private $useCase;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-orders {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '購入情報を送信する';

    /**
     * 
     * @param SendOrdersUseCase $useCase
     * @return void
     */
    public function __construct(SendOrdersUseCase $useCase)
    {
        parent::__construct();

        $this->usecase = $useCase;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->augument('date');

        $targetDate = Carbon::createFromFormat('Ymd', $date);

        // ユースケースクラスの実行
        $this->useCase->run($targetDate);

        $this->info('ok');
    }
}
