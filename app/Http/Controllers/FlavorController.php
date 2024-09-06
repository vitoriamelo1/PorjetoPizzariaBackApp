<?php

namespace App\Http\Controllers;

use App\Models\Flavor;
use App\Http\Requests\{
    FlavorCreatRequest
};
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavors = Flavor::select('id', 'sabor', 'preco', 'tamanho')
            ->withTrashed()
            ->paginate('10');

        return [
            'status' => 200,
            'message' => 'Sabores encontrados!!',
            'sabores' => $flavors
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlavorCreatRequest $request)
    {
        $data = $request->all();

        $flavor = Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => $data['tamanho'],
        ]);

        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flavor = Flavor::find($id);

        if(!$flavor){
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => $flavor
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor encontrado com sucesso!!',
            'user' => $flavor
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $flavor = Flavor::find($id);

        if(!$flavor){
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => $flavor
            ];
        }

        $flavor->update($data);

        return [
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!!',
            'user' => $flavor
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flavor = Flavor::find($id);

        if(!$flavor){
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => $flavor
            ];
        }

        $flavor->delete($id);

        return [
            'status' => 200,
            'message' => 'Sabor deletado com sucesso!!'
        ];

    }
}
