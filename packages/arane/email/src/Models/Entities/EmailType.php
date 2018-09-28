<?php

namespace Arane\Email\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Arane\Email\Events\EmailType\EmailTypeCreated;
use Arane\Email\Events\EmailType\EmailTypeUpdated;
use Arane\Email\Events\EmailType\EmailTypeDeleted;
use Arane\Email\Events\EmailType\EmailTypeRestored;


class EmailType extends Model {

    use SoftDeletes;
    use ModelTrait;
    
    protected $table = 'email_types';
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name', 'slug', 'description'];
    
    protected $dispatchesEvents = [
        'created' => EmailTypeCreated::class,
        'updated'=> EmailTypeUpdated::class,
        'deleted' => EmailTypeDeleted::class,
        'restored' => EmailTypeRestored::class,
    ];
}
