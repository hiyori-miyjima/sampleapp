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
    protected $signature = 'app:export-orders';

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
        $tsv = $this->useCase->run(Carbon::today());

        echo $tsv;
    }
}
