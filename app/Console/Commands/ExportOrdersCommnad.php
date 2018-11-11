<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UseCases\ExportOrdersUseCase;
use Carbon\Carbon;

class ExportOrdersCommnad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var ExportOrdersUsecase
     */
    private $useCase;
    protected $signature = 'app:export-orders {date}{--output=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '購入情報を出力する';

    /**
     * 
     * @param ExportOrdersUseCase $useCase
     * @return void
     */
    public function __construct(ExportOrdersUseCase $useCase)
    {
        parent::__construct();

        $this->useCase = $useCase;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 引数dateの値を取得する
        $date = $this->argument('date');

        // $dateの値（文字列）からCarbonインスタンスを生成
        $targetDate = Carbon::createFromFormat('Ymd', $date);

        // ユースケースクラスに日付を渡す
        $tsv = $this->useCase->run($targetDate;

        // outputオプションの値を取得
        $outputFilePath = $this->option('output');

        // nullであれば未指定なので、標準出力に出力
        if (is_null($outputFilePath)) {
            echo $tsv;
            return;
        }

        // ファイルに出力
        file_put_contents($outputFilePath, $tsv);
    }
}
