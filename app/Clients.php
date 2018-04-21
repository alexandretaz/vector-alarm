<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    protected $fillable = ['name', 'dependents','parent_client', 'cpf', 'contract_id', 'rg', 'tel_com', 'tel_res', 'tel_cel'
        , 'grau_parentesco',  'veiculo',  'contatos_prioridade',  'contatos_autorizados', 'senha', 'contra_senha', 'position', 'procedimentos_especiais', 'code'];
    protected $appends = ['devices'];
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

    public function devices()
    {
        return $this->hasMany('App\Device','owner_id');
    }

    public function alarms()
    {
        return $this->hasMany('App\Alarm');
    }


    public function openAlarms()
    {
        return Alarm::query()->select()->where('client_id','=',$this->id)->whereNull('closed_at')->first();
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

    public function addDevice($imei, $brand, $model, $token)
    {
        $now = new \DateTime();
        $newDevice = new Device();
        $newDevice->imei = $imei;
        $newDevice->brand = $brand;
        $newDevice->model = $model;
        $newDevice->token = $token;
        $newDevice->owner_id = $this->id;
        $newDevice->first_login = $now->format('Y-m-d H:i:s');
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
        $device = Device::select()->where('imei','like', $imei)->where('token','like', $token)->where('authorized','=',1)->first();
        return Clients::findOrFail($device->owner_id);

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
