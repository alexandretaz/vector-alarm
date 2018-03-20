<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    protected $fillable = ['name', 'dependents','parent_client', 'cpf', 'contract_id', 'rg', 'tel_com', 'tel_res', 'tel_cel'
        , 'grau_parentesco',  'veiculo',  'contatos_prioridade',  'contatos_autorizados', 'senha', 'contra_senha', 'position', 'procedimentos_especiais', 'code'];
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
        if(empty($this->attributes['parent_client'])) {
            if (isset($this->attributes['veiculo']) && !empty($this->attributes['veiculo'])) {
                return \json_decode($this->attributes['veiculo']);
            }
        }
        if(isset($this->parent_client_executive) && is_object($this->parent_client_executive) && isset($this->parent_client_executive->veiculo)) {
            return $this->parent_client_executive->veiculo;
        }
        return null;

    }

    public function addDevice($imei)
    {
        $newDevice = new Device();
        $newDevice->imei = $imei;
        $newDevice->owner_id = $this->id;
        $newDevice->save();
    }

    public function getContatosPrioridadeAttribute()
    {
        if(empty($this->attributes['parent_client'])) {
            if (isset($this->attributes['contatos_prioridade']) && !empty($this->attributes['contatos_prioridade'])) {
                return \json_decode($this->attributes['contatos_prioridade']);
            }
        }
       if(isset($this->parent_client_executive) && is_object($this->parent_client_executive) && isset($this->parent_client_executive->contatos_prioridade)) {
        return $this->parent_client_executive->contatos_prioridade;
       }
        return null;
    }

    public function getContatosAutorizadosAttribute()
    {
        if(empty($this->attributes['parent_client'])) {
            if (isset($this->attributes['contatos_autorizados']) && !empty($this->attributes['contatos_autorizados'])) {
                return \json_decode($this->attributes['contatos_autorizados']);
            }
        }
       if(isset($this->parent_client_executive) && is_object($this->parent_client_executive) && isset($this->parent_client_executive->contatos_autorizados)) {
        return $this->parent_client_executive->contatos_autorizados;
       }
        return null;
    }

    public static function getByDevice($imei, $token)
    {
        $device = Device::select()->where('imei','=', $imei)->first();
        $tokenRepo = DB::table('oauth_clients')->select()->where('secret','like', $token)->first();

    }

    public function getCpfAttribute()
    {
        if(empty($this->attributes['id'])) {
            return;
        }

        if(empty($this->attributes['cpf']) ){
            if(empty($this->attributes['parent_client'])) {
                throw new \Exception('Usuário sem CPF e principal');
            }
            else{
                $parent = Clients::findOrFail($this->attributes['parent_client']);
                return $parent->cpf;
            }
            return null;
        }
        return $this->attributes['cpf'];
    }


}
