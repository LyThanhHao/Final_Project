<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\RequestExceptionInterface;

class HandleLargeFileException
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (RequestExceptionInterface $e) {
            if ($e->getStatusCode() == 413) {
                return redirect()->back()
                    ->with('fail', 'The uploaded file is too large. Please upload a smaller file.');
            }

            throw $e;
        }
    }
}
