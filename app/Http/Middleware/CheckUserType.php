<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$types): Response
    {
        $user = $request->user();
        return $request;
        // dd($user);/
        if(!$user){
            dd($request);
            return redirect()->route('admin.login-page');
        }
        if($user){
            
        // if(!in_array($user->type ,$types)){
            return abort(403);
        }
        // return $next($request);
    }
}
