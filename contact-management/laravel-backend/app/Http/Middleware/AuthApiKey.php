<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->header('Authorization');
            if (!$token) {
                throw new Exception;
            }
            $user = User::where('token', $token)->firstOrFail();
            Auth::login($user);
            return $next($request);
        } catch (Throwable $th) {
            throw new HttpResponseException(
                response([
                    'errors' => [
                        'token' => ['Unauthorized']
                    ]
                ], 401)
            );
        }
    }
}
