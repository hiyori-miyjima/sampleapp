<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

use function strval;

final class HeaderDumper
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request instanceof Request) {
            $this->logger->info('request', [
                'header' => strval($request->headers)
            ]);
            // ヘルパー関数を利用する場合は以下を利用する
            // info('request', ['header' => strval($request->headers)]);
        }
        return $next($request);
    }
}
