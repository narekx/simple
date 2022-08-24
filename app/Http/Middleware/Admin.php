<?php


namespace App\Http\Middleware;


use App\Enums\UserRoles;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Admin
{
    /**
     * @var
     */
    protected $auth;

    /**
     * Admin constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|mixed
     */
    public function handle ($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        } else {
            if ($this->auth->user()->role != UserRoles::ADMIN) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
