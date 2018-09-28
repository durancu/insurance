<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission.
 *
 * @package namespace Arane\Base\Models\Entities;
 */
class Permission extends Model {
    use ModelTrait;
    use SoftDeletes;
    
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    protected $shown = ['id', 'key', 'table_name'];
    
    public function getShownAttribute(){
        return $this->shown;
    }

}
