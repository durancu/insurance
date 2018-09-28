<?php

namespace Arane\Email\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmailTemplate extends Model {
    
    use SoftDeletes;
    use ModelTrait;
    
    protected $table = 'email_templates';
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name', 'type', 'path', 'fields', 'description', 'format'];
}
