<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\PostTooLargeException;

class HandlePostTooLarge
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (PostTooLargeException $e) {
            // Redirect lại với thông báo lỗi thân thiện
            return redirect()->back()
                ->with('fail', 'The uploaded file is too large. Please upload a file less than 20MB.');
        }
    }
}
