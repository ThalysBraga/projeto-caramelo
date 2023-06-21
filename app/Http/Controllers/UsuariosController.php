<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{

        public function indexAnimais(Request $request)
        {
            return $this->view()->with('animais'->get());
        }

        public function edit(Request $request, Controller $controller)
        {
            return $this->view()->with('usuario', $controller);
        }
        
        public function update(Request $request, Controller $controller)
        {
            if (!$this->validarDados($request, $controller)) {
                return redirect()->back()->withInput();
            }
    
            $controller->update($this->prepararDados($request));
    
            $request->session()->flash(
                'success',
                'Usuario atualizado com sucesso.'
            );
    
            return $this->redirect('index');
        }
        public function create()
        {
            return view('usuario.create');
        }
        
        public function store(Request $request)
        {
            $dadosPreparados = $this->dadosPreparados($request->all());
            Controller::create($dadosPreparados);
            return redirect()->route('cadastro.index');
        }
        public function dadosPreparados($params)
        {
            return[
                'nome' => $params['nome'],
                'telefone' => $params['telefone'],
                'email' => $params['email'],
                'confirmarEmail' => $params['confirmarEmail'],
                'senha' => $params['senha'],
                'confirmarSenha' => $params['confirmarSenha'],
                'status' => false,
            ];
        }     
    }




   