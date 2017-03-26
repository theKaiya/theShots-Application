<?php

namespace App\Http\Middleware;

use Closure;

class PreviousUrlMiddleware
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
        /**
         * If have $_GET['back'] or something else for redirecting to previous page
         * put this in the session
        */
        if($request->has('back') || $request->has('action') || $request->has('action_id')) {
            session()->put('previous', [
              'back' => $request->back,
              'action' => $request->action,
              'action_id' => $request->action_id,
              'action_data' => $request->action_data
            ]);
        }

        return $next($request);
    }
}
