<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Message;

class MarkMessageAsUnread
{
    public function handle($request, Closure $next)
    {
        // Get the message ID from the request parameters
        $id = $request->input('id');

        // Update the message state to 0 (unread)
        Message::where('id', $id)->update(['state' => 0]);

        return $next($request);
    }
}
