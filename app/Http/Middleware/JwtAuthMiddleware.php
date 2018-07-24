<?php

namespace App\Http\Middleware;

use App\Exceptions\JwtAuthFailedException;
use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\JWTAuth;

class JwtAuthMiddleware
{
    /**
     * @var Dispatcher
     */
    private $events;

    public function __construct(Dispatcher $events, JWTAuth $auth)
    {
        $this->auth = $auth;
        $this->events = $events;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws JwtAuthFailedException
     */
    public function handle($request, Closure $next)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            throw new JwtAuthFailedException(7, 'Token not provided', [], 200);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            throw new JwtAuthFailedException(8, 'Token expired', [], 200);
        } catch (JWTException $e) {
            throw new JwtAuthFailedException(9, 'Token invalid', [], 200);
        }

        if (! $user) {
            throw new JwtAuthFailedException(10, 'User not found', [], 200);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
