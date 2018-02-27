<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'client_cnpj','client_name', 'client_alias', 'number_of_connections'];

    public function clients ()
    {
        return $this->hasMany('App\Clients');
    }

    public function getRootClientsAttribute()
    {
        return Clients::select()->where('contract_id','=', $this->id)->whereNull('parent_client')->get();
    }

}
