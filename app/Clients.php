<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    protected $fillable = ['name', 'dependents','parent_client', 'cpf', 'contract_id', 'rg', 'tel_com', 'tel_res', 'tel_cel'
        , 'grau_parentesco',  'veiculo',  'contatos_prioridade',  'contatos_autorizados', 'senha', 'contra_senha', 'procedimentos_especiais', 'code'];
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

    public function alarms()
    {
        return $this->hasMany('App\Alarm');
    }

    public function helps()
    {
        return $this->hasMany('App\Help');
    }

    public function getCodeAttribute()
    {
        if(!empty($this->attributes['code'])) {
            return $this->attributes['code'];
        }


        if(empty($this->parent_client)) {
            $idFormated = str_pad($this->id,4,"0",STR_PAD_LEFT);
            $idFormated.='/01';
        }
        else{
            $idFormated = str_pad($this->parent_client,4,"0",STR_PAD_LEFT);
            $idFormated.='/'.str_pad($this->position,2,"0",STR_PAD_LEFT);
        }
        return $idFormated;
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

    public static function getByDevice($imei, $token)
    {
        $device = Device::select()->where('imei','=', $imei)->first();
        $tokenRepo = DB::table('oauth_clients')->select()->where('secret','like', $token)->first();

    }

}
