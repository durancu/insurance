<?php

namespace Arane\Vehicle\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vehicle extends Model {
    
    use SoftDeletes;
    
    protected $table = 'vehicles';
    
    protected $dates = ['created_at', 'updated_at'];
    
    protected $guarded = [];
    
    protected $shown = ['id', 'make', 'model', 'year', 'cylinders', 'drive', 'trany', 'fuel_type'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }
    
}
