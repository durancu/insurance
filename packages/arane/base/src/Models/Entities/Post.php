<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 *
 * @package namespace Arane\Base\Models\Entities;
 */
class Post extends Model {
    use ModelTrait;
    
    protected $shown = ['id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    public function author(){
        return $this->belongsTo(User::class);
    }
    
}
