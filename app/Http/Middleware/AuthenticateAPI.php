<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAPI extends Middleware
{
protected function authenticate($request, array $guards)
{
  $token = $request->query('api_token');
  if(!$token){
      $token = $request->input('api_token');
  }
  if(!$token){
      $token = $request->bearerToken();
  }
if($token === config('apitokens')[0]) return;
$this->unauthenticated($request,$guards);
}
}
