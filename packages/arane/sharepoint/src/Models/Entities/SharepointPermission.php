<?php

namespace Arane\Sharepoint\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sharepoint.
 *
 * @package namespace Arane\SharepointModels\Entities;
 */
class SharepointPermission extends Model {

    use SoftDeletes;

    protected $table = 'sharepoint_permission';

    protected $dates = ['deleted_at'];

    protected $fillable = ['sharepoint_id','user_id','permission'];
    
    protected $shown = ['sharepoint_id', 'user_id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
}
