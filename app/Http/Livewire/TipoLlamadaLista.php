<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TipoLlamada;

class TipoLlamadaLista extends Component
{
    use WithPagination;

    public $search_term;
    public $new_modal, $show_delete, $show_edit;
    public $tipo_llamada, $tipo;

    public function mount()
    {
        $this->new = false;
        $this->show_delete = false;
        $this->show_edit = false;
    }

    protected $rules = [
        'tipo_llamada' => 'required|string'
    ];

    public function showNew()
    {
        $this->new_modal = true;
    }

    public function actionSaveModal()
    {
        $validado = $this->validate();
        $gestion = TipoLlamada::create([
            'tipo_llamada' => $this->tipo_llamada,

        ]);
        $this->new_modal = false;
        session()->flash('info', 'Se ha ingresado el resgistro!.');
    }

    public function showDeleteModal(TipoLlamada $tipo)
    {
        $this->show_delete = true;
        $this->tipo = $tipo;
    }

    public function actionDelete()
    {
        $this->tipo->forceDelete();
        $this->show_delete = false;
        session()->flash('info', 'Operación realizada!.');
    }

    public function editModal(TipoLlamada $tipo)
    {
        $this->show_edit = true;
        $this->tipo = $tipo;
        $this->tipo_llamada = $this->tipo->tipo_llamada;
    }

    public function actionUpdateModal()
    {
        $validado = $this->validate();
        $this->tipo->update($validado);
        $this->show_edit = false;
        session()->flash('info', 'Operación realizada!.');
    }

    public function render()
    {
        $search_term = '%'.$this->search_term.'%';
        return view('livewire.tipo-llamada-lista', ['data' => TipoLlamada::where('tipo_llamada','like', $search_term)->orderBy('id', 'desc')->paginate(10)]);
    }
}
