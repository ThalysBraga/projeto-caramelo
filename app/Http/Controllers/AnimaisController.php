<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimaisController extends Controller
{
    public function index()
    {
        return redirect()->view('animais.index')
            ->with('animais', Animal::all());
    }

    public function create()
    {
        return redirect()->view('animais.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'contato' => 'required',
            'tipo' => 'required',
            'descricao' => 'required',
            'path_image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Animal::create($this->dadosPreparados($request));

        return $this->redirect('index');
    }

    public function edit(Animal $animal)
    {
        return redirect()->view('animais.edit')
            ->with('animal', $animal);
    }
    
    public function update(Request $request, Animal $animal)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'contato' => 'required',
            'tipo' => 'required',
            'descricao' => 'required',
            'path_image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $animal->update($this->dadosPreparados($request));

        return $this->redirect('index');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->view('animais.index');
    }

    public function dadosPreparados($params)
    {
        return [
            'nome' => $params['nome'],
            'tipo' => $params['tipo'],
            'contato' => $params['contato'],
            'descricao' => $params['descricao'],
            'path_image' => $params['path_image'],
            'usuario_id' => auth()->user()?->id,
        ];
    }
}
