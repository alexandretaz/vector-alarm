<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    protected $fillable = ['client_id','start_panic', 'start_help', 'update_panic','update_help','tel_to_call'];


}
