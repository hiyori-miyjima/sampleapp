<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UseCases\SendOrdersUseCase;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use App\Services\ChatWorkService;

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

    /** @var LoggerInterface */
    private $logger;

    /** @var ChatWorkService */
    private $chatwork;

    /**
     * @param SendOrdersUseCase $useCase
     * @param LoggerInterface $logger
     * @param ChatWorkService $chatwork
     */
    public function __construct(
        SendOrdersUseCase $useCase, 
        LoggerInterface $logger,
        ChatWorkService $chatwork
    ){
        parent::__construct();

        $this->usecase = $useCase;
        $this->logger  = $logger;
        $this->chatwork= $chatwork;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // バッチ処理開始ログ
        $this->logger->info(__METHOD__.''>'start');

        $date = $this->augument('date');
        $targetDate = Carbon::createFromFormat('Ymd', $date);

        // バッチコマンド引数を出力
        $this->logger->info('TargetDate:'.$date);

        $count = $this->useCase->run($targetDate);

        // ChatWorkへ通知
        $message = sprintf('対象日：％s/送信件数%d件', $targetDate->toDateString(), $count);
        $this->chatwork->sendMessage('購入情報送信バッチ', $message);

        // バッチ処理終了ログ
        $this->logger->info(__METHOD__.''.'done sent_count:'.$count);
    }
}
