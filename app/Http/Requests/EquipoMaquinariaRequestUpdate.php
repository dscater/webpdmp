<?php

namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipoMaquinariaRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => 'unique:maquinarias,codigo,' . $this->maquinaria->id,
            'user_id' => 'unique:maquinarias,user_id,' . $this->maquinaria->id,
        ];
    }

    public function messages()
    {
        return [
            'codigo.unique' => 'Ya hay alguien registrado con este número de C.I..',
            'user_id.unique' => 'Este usuario ya tiene asignado un Equipo/Maquinaria.',
        ];
    }
}
