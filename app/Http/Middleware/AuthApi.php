<?php

namespace App\Http\Middleware;

use Closure;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        if ( $request->header('Authorization') == null ) {
            $arrayJson = array(
                "error" => "Authorization not found"
            );
            return response()->json($arrayJson, 401);
        }else{
            $base64Key = base64_encode('GrupoZanon'); // Em uma api para vários clientes trocaria GrupoZanon por uma busca no banco de dados por chaves privadas dos clientes | optei por não utilizar env('APP_KEY','');
            $arrayAuthorization = explode('Basic ', $request->header('Authorization'));
            $authorization = $arrayAuthorization[1];
            if( $authorization != $base64Key ){
                $arrayJson = array(
                    "error" => "Authorization invalid"
                );
                return response()->json($arrayJson, 401);
            }
        }
        return $next($request);
    }
}
