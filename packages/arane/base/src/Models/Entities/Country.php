<?php

namespace Arane\Base\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country.
 *
 * @package namespace Arane\Base\Models\Entities;
 */
class Country extends Model {
    
    use ModelTrait;
    use SoftDeletes;
    
    protected $table = "countries";
    
    protected $casts = [];
    
    protected $guarded = [];
    
    protected $attributes = [];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    protected $shown = ['id'];
    
    public function getShownAttribute(){
        return $this->shown;
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();
    }
    
    
}
