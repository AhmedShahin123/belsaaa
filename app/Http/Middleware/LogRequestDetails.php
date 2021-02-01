<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (config('app.log_request_details')) {
            Log::channel('request')->info($request->getPathInfo(), [
                'headers' => $request->headers->all(),
                'request' => $request->request->all(),
                'request_files' => iterator_to_array($request->files),
                'query' => $request->query->all(),
                'response_status' => $response->status(),
                'response_body' => $request->acceptsHtml() ? '' : $response->content(),
                'full_url' => $request->fullUrl(),
                'scheme' => $request->getSchemeAndHttpHost(),
            ]);
        }

        return $response;
    }
}
