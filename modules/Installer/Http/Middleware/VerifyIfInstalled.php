<?php

namespace Modules\Installer\Http\Middleware;

use Closure;

class VerifyIfInstalled {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(env('APP_INSTALLED', false) === false && !$request->is('installer*'))
        {
            if(!$request->is('_debugbar*')){
                return redirect()->route('installerUrl');
            }
        }elseif(env('APP_INSTALLED', false) === true && $request->is('installer*'))
        {
            return redirect()->to('/');
        }
        return $next($request);
    }

}