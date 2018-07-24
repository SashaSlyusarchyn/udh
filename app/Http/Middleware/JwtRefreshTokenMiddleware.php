<?php

namespace App\Http\Middleware;

use App\Exceptions\JwtRefreshTokenFailedException;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class JwtRefreshTokenMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws JwtRefreshTokenFailedException
     */
    public function handle($request, \Closure $next)
    {
        try {
            $newToken = $this->auth->setRequest($request)->parseToken()->refresh();
        } catch (TokenExpiredException $e) {
            throw new JwtRefreshTokenFailedException(8, 'Token expired', [], 200);
        } catch (JWTException $e) {
            throw new JwtRefreshTokenFailedException(9, 'Token invalid', [], 200);
        }

        $request->attributes->add(['newToken' => $newToken]);

        return $next($request);
    }
}
