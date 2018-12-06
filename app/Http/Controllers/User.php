<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    /**
     * Cria o usuário
     *
     * @param Request $request
     * @return json Retorna um JSON com os dados do usuário criado ou com a mensagem de erro 
     */
    public function create(Request $request){

        $store = $this->store($request);
        if( is_array($store) ){
            return response()->json($store, 400);
        }
        
        $user = new UserModel;
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT); // http://php.net/manual/pt_BR/function.password-verify.php | utilizar password_verify( $password , $passwordHash) para comparar a senha com a senha do banco
        $user->cpf = $request->input('cpf');
        $save = $user->save();
        if($save){
            $arrayJson = $user->getAttributes();
            unset($arrayJson['password']); // remove pra não mostrar na resposta
            return response()->json($arrayJson, 201);
        }else{
            $arrayJson = array(
                "error" => "Error in attempt the create a user."
            );
            return response()->json($arrayJson, 500);
        }
    }
    /**
     * Faz as validações
     *
     * @param Request $request
     * @return true|array Retorna true se estiver tudo certo ou uma array com o erro.
     */
    public function store(Request $request){  
        $validator = Validator::make($request->all(), [
           'email' => 'required|email|unique:users',
           'name' => 'required|string|max:255',
           'last_name' => 'required|string|max:255',
           'password' => 'required',
           'password_verified' => 'required|same:password',
           'cpf' => 'required|max:14',
       ]);
       if ( $validator->fails() ) {
            $arrayJson = array(
                "error" => $validator->messages()->first(),
            );
            return $arrayJson;
       }else{
           return true;
       }
    }
}
