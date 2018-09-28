<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class State extends Model {

    use ModelTrait;

    protected $table = 'states';

    protected $guarded = [];

    public $incrementing = false;
    public $keyType = 'string';
    
    protected $casts = [];
    
    protected $attributes = [];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    protected $shown = ['id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }

}
