<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function indexAnimais()
    {
        return redirect()->view('usuario.index-animais')
            ->with('animais', Usuario::with('animais')->get());
    }

    public function show(Usuario $usuario) 
    {
        return redirect()->view('usuario.show')
            ->with('usuario', $usuario);
    }

    public function create()
    {
        return redirect()->view('usuario.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',
            'senha' => 'required',
            'contato' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Usuario::create($this->dadosPreparados($request));

        return $this->redirect('indexAnimais');
    }

    public function edit(Usuario $usuario)
    {
        return redirect()->view('usuario.edit')
            ->with('usuario', $usuario);
    }
    
    public function update(Request $request, Usuario $usuario)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',
            'senha' => 'required',
            'contato' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $usuario->update($this->dadosPreparados($request));

        return $this->redirect('indexAnimais');
    }

    public function dadosPreparados($params)
    {
        return [
            'nome' => $params['nome'],
            'email' => $params['email'],
            'senha' => $params['senha'],
            'contato' => $params['contato'],
        ];
    }
}
