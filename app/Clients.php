<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = ['name', 'dependents','parent_client', 'cpf', 'contract_id', 'rg', 'tel_com', 'tel_res', 'tel_cel'
        , 'grau_parentesco',  'veiculo',  'contatos_prioridade',  'contatos_autorizados', 'senha', 'contra_senha', 'procedimentos_especiais'];
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function getParentClientExecutiveAttribute()
    {
        if(!empty($this->parent_client)) {
            return Clients::findOrFail($this->parent_client);
        }
        return null;
    }

    public function getDependentsAttribute()
    {
        return Clients::select()->where('parent_client','=', $this->id)->get();
    }

    public function getVeiculoAttribute()
    {
        if(isset($this->attributes['veiculo']) && !empty($this->attributes['veiculo']) ) {
            return \json_decode($this->attributes['veiculo']);
        }
    }

    public function getContatosPrioridadeAttribute()
    {
        if(isset($this->attributes['contatos_prioridade']) && !empty($this->attributes['contatos_prioridade']) ) {
            return \json_decode($this->attributes['contatos_prioridade']);
        }
    }

    public function getContatosAutorizadosAttribute()
    {
        if(isset($this->attributes['contatos_autorizados']) && !empty($this->attributes['contatos_autorizados']) ) {
            return \json_decode($this->attributes['contatos_autorizados']);
        }
    }

}
