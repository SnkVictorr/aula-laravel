<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->header('admin') !== 'true') {
            return response()->json(["message" => "usuário não autorizado"], 403);
        }

        // Se a verficação dar fcerto, usamos next para ir para próxima etapa
        return $next($request);
    }
}
