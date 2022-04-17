<?php

namespace App\Http\Middleware;

use Closure;

class PageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $access = false;
        foreach ($request->user()->role as $key => $value) {
            if (in_array($value->kode_role, $roles)) {
                $access = true;
            }
        }
        if ($access)
        {
            return $next($request);
        }elseif($request->user()->isAdmin){
            return redirect()->route("dashboard")->with("message", "Admin Can't Access that page");
        }
        return abort(403, "User Can't Access This Page");
    }
}
