<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{    
    /**
     * Boa vinda
     *
     * @param Request $request
     * @return json Retona um JSON com o nome e a versão da API
     */
    public function index(){
        $arrayJson = array(
            "api" => "Grupo Zanon",
            "version" => "1.0"
        );
        return response()->json($arrayJson, 200);
    }
    /**
     * Dados do usuário
     *
     * @param int $id Campo id do usuário na table users
     * @return json Retorna um JSON com os dados do usuário ou com a mensagem de erro 
     */
    public function read($id){
        $user = new UserModel;
        $result = $user->find($id);
        if($result == null){
            $arrayJson = array(
                "error" => "User not found"
            );
            return response()->json($arrayJson, 404);
        }else{
            $arrayJson = $result->getAttributes();
            unset($arrayJson['password']); // remove pra não mostrar na resposta
            return response()->json($arrayJson, 200);
        }        
    }
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
     * Avisa para usar o método PUT para alterar os dados do usuário
     *
     * @param Request $request
     * @return json Retorna um JSON com a o aviso
     */
    public function advice(){
        $arrayJson = array(
            "error" => "Use method PUT for update"
        );
        return response()->json($arrayJson, 200);
    }
    /**
     * Altera o usuáro
     *
     * @param Request $request
     * @param [type] $id
     * @return json Retorna um JSON com os dados do usuário alterado ou com a mensagem de erro 
     */
    public function update(Request $request, $id){
        $store = $this->store($request);
        if( is_array($store) ){
            return response()->json($store, 400);
        }
        $user = new UserModel;
        $result = $user->findOrFail($id)->update($request->all());
        if($result){            
            $arrayJson = $user->find($id);
            unset($arrayJson['password']); // remove pra não mostrar na resposta      
            return response()->json($arrayJson, 200);      
        }     
    }
    /**
     * Deleta o usuário
     *
     * @param int $id Campo id do usuário na table users
     * @return json Retorna um JSON com a mensagem de sucesso ou de erro 
     */
    public function delete($id){
        $user = new UserModel;
        $result = $user->find($id);
        if($result == null){
            $arrayJson = array(
                "error" => "User not found"
            );
            return response()->json($arrayJson, 404);
        }else{
            $user->find($id)->delete();
            $arrayJson = array(
                "message" => "User deleted"
            );
            return response()->json($arrayJson, 200);
        }        
    }
    /**
     * Faz as validações
     *
     * @param Request $request
     * @return true|array Retorna true se estiver tudo certo ou uma array com o erro.
     */
    public function store(Request $request){  
        switch ($request->method()) {
            case 'POST':
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                    'name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'password' => 'required',
                    'password_verified' => 'required|same:password',
                    'cpf' => 'required|max:14',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($request->all(), [
                    'email' => 'email|unique:users',
                    'name' => 'string|max:255',
                    'last_name' => 'string|max:255',
                    'cpf' => 'max:14',
                ]);
                break;      
        }
        
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
