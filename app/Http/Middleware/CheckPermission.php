<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckPermission
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
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
      $roles = isset($request->route()->getAction()['roles']) ? $request->route()->getAction()['roles'] : null;
      if($this->auth->guest()) {
        return $request->ajax() ? response('Unauthorize', 401) : redirect()->route('login');
      }
      if($this->auth->user()->hasAnyRole($roles)) {
        return $next($request);
      }
      return $request->ajax() ? response('Unauthorize', 401) : redirect()->route('login');
    }
}
