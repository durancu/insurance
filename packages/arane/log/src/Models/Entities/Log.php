<?php

namespace Arane\Log\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Log extends Model {
    
    use SoftDeletes;
    
    protected $table = 'logs';
    
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $fillable = ['user_id', 'service', 'action', 'result', 'message'];
    
    protected $shown = ['id', 'user_id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }

    public function user(){
        return $this->belongsTo('Arane\Base\Models\Entities\User', 'user_id');
    }

    public function getDateAttribute() {
        return $this->created_at->format('m-d-Y');
    }
}
