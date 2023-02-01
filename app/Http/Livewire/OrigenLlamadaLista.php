<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrigenLlamada;

class OrigenLlamadaLista extends Component
{
    use WithPagination;

    public $search_term;
    public $new_modal, $show_delete, $show_edit;
    public $origen_llamada, $origen;

    public function mount()
    {
        $this->new = false;
        $this->show_delete = false;
        $this->show_edit = false;
    }

    protected $rules = [
        'origen_llamada' => 'required|string'
    ];

    public function showNew()
    {
        $this->new_modal = true;
    }

    public function actionSaveModal()
    {
        $validado = $this->validate();
        $gestion = OrigenLlamada::create([
            'origen_llamada' => $this->origen_llamada,

        ]);
        $this->new_modal = false;
        session()->flash('info', 'Se ha ingresado el registro!.');
    }

    public function showDeleteModal(OrigenLlamada $origen)
    {
        $this->show_delete = true;
        $this->origen = $origen;
    }

    public function actionDelete()
    {
        if (count($this->origen->gestiones) > 0) {
            $this->show_delete = false;
            session()->flash('warning', 'Este registro ya se encuentra relacionado con otras entradas!.');
        }else{
            $this->origen->forceDelete();
            $this->show_delete = false;
            session()->flash('info', 'Operación realizada!.');
        }
    }

    public function editModal(OrigenLlamada $origenLlamada)
    {
        $this->show_edit = true;
        $this->origen = $origenLlamada;
        $this->origen_llamada = $this->origen->origen_llamada;
    }

    public function actionUpdateModal()
    {
        $validado = $this->validate();
        $this->origen->update($validado);
        $this->show_edit = false;
        session()->flash('info', 'Operación realizada!.');
    }

    public function render()
    {
        $search_term = '%'.$this->search_term.'%';
        return view('livewire.origen-llamada-lista', ['data' => OrigenLlamada::where('origen_llamada','like', $search_term)->orderBy('id', 'desc')->paginate(10)]);
    }
}
