<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserData extends Model
{
    protected $guarded = [];

    protected $casts = [
        'params' => 'array'
    ];

    public function updateData($data)
    {
        $options = $this->params;
        foreach($data['dirty'] as $dirtyArray) {
            if(is_int($dirtyArray)) {
                $options['params'][$dirtyArray] = $data['params']['params'][$dirtyArray];
            } else {
                $options[$dirtyArray] = $data['params'][$dirtyArray];
            }
        }
        $this->params = $options;
        $this->save();
    }
}
