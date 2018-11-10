<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\PdfGenerator;
use Illuminate\Contracts\Bus\Dispatcher;

class PdfGeneratorController extends Controller
{
	public function index()
	{
		PdfGenerator::dispatch(storage_path('pdf/sample.pdf'));
	}

	// インターフェースを記述し、メソッドインジェクションでインスタンス生成を行う

	public function methodInjectExample(Dispatcher $dispatcher)
	{
		$generator = new PdfGenerator(storage_path('pdf/sample.pdf'));
		// dispatchメソッドで実行指示
		$dispatcher->dispatch($generator);
	}
}