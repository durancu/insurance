<?php

namespace Arane\File\Models\Entities;

use Arane\Base\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Arane\File\Events\FileCopied;
use Arane\File\Events\FileCreated;
use Arane\File\Events\FileRestored;
use Arane\File\Events\FileDeleted;
use Arane\File\Events\FileUpdated;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

/**
 * Class File.
 *
 * @package namespace Arane\File\Models\Entities;
 */
class File extends Model {

    use ModelTrait;
    use SoftDeletes, HasTags;

    ////////////////////////////////////////////  MODEL  ATTRIBUTES   ////////////////////////////////////////

    /**
     * @var string
     */
    protected $table = 'files';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['stored_id', 'name', 'path', 'type', 'disk'];

    /**
     * @var array
     */
    protected $appends = ['full_url', 'filename'];

    /**
     * @var array
     */
    protected $shown = ['id'];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => FileCreated::class,
        'updated' => FileUpdated::class,
        'deleted' => FileDeleted::class,
        'restored' => FileRestored::class,
        'copied' => FileCopied::class,
    ];

    ////////////////////////////////////////////  MODEL  CUSTOM ATTRIBUTES   ////////////////////////////////////////

    /**
     * @return array
     */
    public function getShownAttribute() {
        return $this->shown;
    }

    /**
     * @return mixed
     */
    public function getFullUrlAttribute() {
        return Storage::disk($this->disk)->url($this->path . $this->stored_id);
    }

    /**
     * @return string
     */
    public function getFilenameAttribute() {
        return $this->name . '.' . $this->type;
    }

}
