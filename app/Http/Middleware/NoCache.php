<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse; // Importa Symfony Response
use Illuminate\Http\Response; // Importa Illuminate Response

class NoCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $symfonyResponse = $next($request);

        if ($symfonyResponse instanceof SymfonyResponse) {
            $response = new Response(
                $symfonyResponse->getContent(),
                $symfonyResponse->getStatusCode(),
                $symfonyResponse->headers->all()
            );

            return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }

        return $symfonyResponse;
    }
}
