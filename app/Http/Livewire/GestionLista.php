<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gestion;
use App\Models\OrigenLlamada;
use App\Models\TipoLlamada;
use Livewire\WithPagination;

class GestionLista extends Component
{
    use WithPagination;

    public $search_term;
    public $new_modal, $show_delete, $show_edit;
    public $origen_llamdas, $tipo_llamadas, $gestionE;
    public $nombre, $telefono, $origen_llamada_id, $gestion, $tipo_llamada_id;

    public function mount()
    {
        $this->new = false;
        $this->show_delete = false;
        $this->show_edit = false;
        $this->origen_llamadas = OrigenLlamada::all();
        $this->tipo_llamadas = TipoLlamada::all();
    }

    public function showNew()
    {
        $this->new_modal = true;
    }

    protected $rules = [
        'tipo_llamada_id' => 'required|integer',
        'origen_llamada_id' => 'required|integer',
        'nombre' => 'required|string',
        'telefono' => 'required|max:9',
        'gestion' => 'string',
    ];

    public function actionSaveModal()
    {
        $validado = $this->validate();
        $gestion = Gestion::create([
            'tipo_llamada_id' => $this->tipo_llamada_id,
            'origen_llamada_id' => $this->origen_llamada_id,
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'gestion' => $this->gestion,

        ]);
        $this->new_modal = false;
        session()->flash('info', 'Se ha ingresado la gestion!.');
    }

    public function showDeleteModal(Gestion $gestion)
    {
        $this->show_delete = true;
        $this->gestionE = $gestion;
        // dd($this->gestionE);
    }

    public function actionDelete()
    {
        $this->gestionE->forceDelete();
        $this->show_delete = false;
        session()->flash('info', 'Operación realizada!.');
    }

    public function editModal(Gestion $gestion)
    {
        $this->show_edit = true;
        $this->gestionE = $gestion;

        $this->nombre = $this->gestionE->nombre;
        $this->telefono = $this->gestionE->telefono;
        $this->origen_llamada_id = $this->gestionE->origen_llamada_id;
        $this->gestion = $this->gestionE->gestion;
        $this->tipo_llamada_id = $this->gestionE->tipo_llamada_id;
    }

    public function actionUpdateModal()
    {
        $validado = $this->validate();
        $this->gestionE->update($validado);
        $this->show_edit = false;
        session()->flash('info', 'Operación realizada!.');
    }

    public function render()
    {
        $search_term = '%'.$this->search_term.'%';
        return view('livewire.gestion-lista', ['data' => Gestion::where('nombre','like', $search_term)->orderBy('id', 'desc')->paginate(10)]);
    }
}
