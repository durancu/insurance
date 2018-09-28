<?php

namespace Arane\File\Services\Handlers;

use Arane\Base\Services\Handlers\BaseModelService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\File\Models\Entities\File;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Way\Generators\Filesystem\FileNotFound;

/**
 * Class FileService
 *
 * @package Arane\Base\Services\Handlers
 */
class FileService extends BaseModelService {
    
    /**
     * @var SystemService
     */
    protected $systemService;
    
    /**
     * FileService constructor.
     *
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService) {
        parent::__construct();
        
        $this->systemService = $systemService;
    }
    
    /**
     * Define FileService model
     *
     * @param  array $attributes
     * @return string
     *
     */
    public function model() {
        return File::class;
    }
    
    /**
     * Store a new File in storage.
     *
     * @param  $attributes
     * @param  $content
     *
     * @return Model
     * @throws \Exception
     */
    public function create($attributes, $content = null, $base64 = false) {
        
        if (!isset($content)) {
            throw new FileException("File content is missing", 200);
        }
        
        //Generate file name from unique id
        $store_id = uniqid();
        
        //Determine filesystem to use
        $disk = (isset($attributes['disk'])) ? $attributes['disk'] : config('arane-file.storage.disk');
        
        //Set default path to store files
        $basePath = $this->cleanPath(config('arane-file.disk.' . $disk . '.paths.default'));
        
        //Set destination file's folder
        $filePath = $this->cleanPath($basePath . (isset($attributes['path']) ? $attributes['path'] : config('arane-file.disk.' . $disk . '.paths.others')));
        
        //Get file name and extension to use in database record
        if (!$base64) {
            $fileFullName = $content->getClientOriginalName();
        } else {
            $fileFullName = $content['filename'];
        }
        
        $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
        $fileType = pathinfo($fileFullName, PATHINFO_EXTENSION);
        
        //Store file in filesystem
        if (!$base64) {
            $content->storeAs($filePath, $store_id, ['disk' => $disk]);
        } else {
            Storage::disk($disk)->put($filePath . $store_id, base64_decode($content['base64']));
        }
        
        return parent::create(['stored_id' => $store_id, 'name' => $fileName, 'path' => $filePath, 'type' => $fileType, 'disk' => $disk]);
    }
    
    
    /**
     * Update the specified File.
     *
     * @param  array $attributes
     * @param  int   $id
     *
     * @return int
     * @throws FileNotFound
     * @throws \Exception
     */
    public function update($id, $attributes, $notFoundCreate=false, $noException=false) {
        
        $id = is_array($id) ? $id : [$id];
        
        $files = $this->model->whereIn('id', $id)->get();
        
        $updated = 0;
        foreach ($files as $file) {
            
            //Set default path to store files
            $basePath = $this->cleanPath(config('arane-file.disk.' . $file->disk . '.paths.default'));
            
            if (isset($attributes['path']) && Storage::disk($file->disk)->exists($file->path . $file->stored_id)) {
                
                Storage::disk($file->disk)->move($file->path . $file->stored_id, $basePath . $this->cleanPath($attributes['path']) . $file->stored_id);
                $attributes['path'] = $basePath . $this->cleanPath($attributes['path']);
            }
            
            $updated += parent::update($file->id, $attributes);
        }
        
        return $updated;
    }
    
    /**
     * Remove the specified File from storage.
     *
     * @param  int $id
     *
     * @return int
     */
    public function delete($id, $trashed = false) {
        
        $id = is_array($id) ? $id : [$id];
        
        $files = $trashed ? $this->model->withTrashed()->whereIn('id', $id)->get() : $this->model->whereIn('id', $id)->get();
        
        $deleted = 0;
        foreach ($files as $file) {
            
            //Remove file from filesystem
            if (Storage::disk($file->disk)->exists($file->path . $file->stored_id)) {
                
                if ($trashed) {
                    Storage::disk($file->disk)->delete($file->path . $file->stored_id);
                } else {
                    //Move to trash bin folder rather than delete it permanently
                    Storage::disk($file->disk)->move($file->path . $file->stored_id, $this->cleanPath(config('arane-file.disk.' . $file->disk . '.paths.trash')) . $file->stored_id);
                    $this->model->where('id', $file->id)->update(['path' => $this->cleanPath(config('arane-file.disk.' . $file->disk . '.paths.trash'))]);
                }
                
                $deleted += parent::delete($file->id, $trashed);
            }
        }
        
        return $deleted;
    }
    
    
    /**
     * Restores the specified File.
     *
     * @param string    $path
     * @param int       $id
     *
     * @return int
     */
    public function restore($id, $path=null) {
        
        $id = is_array($id) ? $id : [$id];
        
        $files = $this->model->onlyTrashed()->whereIn('id', $id)->get();
        
        $restored = 0;
        foreach ($files as $file) {
            //Restore file from filesystem
            if ((Storage::disk($file->disk)->exists($file->path . '/' . $file->stored_id))) {
                
                //Set default path to store files
                $basePath = $this->cleanPath(config('arane-file.disk.' . $file->disk . '.paths.default'));
                
                
                $path = isset($path) ? $path : config('arane-file.disk.' . $file->disk . '.paths.others');
                
                $path = $basePath . $this->cleanPath($path);
                
                Storage::disk($file->disk)->move($file->path . $file->stored_id, $path . $file->stored_id);
                
                parent::restore($file->id);
                
                parent::update($file->id, ['path' => $path]);
                
                $restored++;
                
            } else {
                
                $this->delete($file->id, true);
            }
        }
        
        return $restored;
        
    }
    
    
    /**
     * Copy file on new directory and new name passed by request parameters, create a new file on the DB
     *
     * @param int $id
     * @param string $toPath
     * @param string $newName
     *
     * @return mixed
     */
    function copy($id, $toPath=null, $newName=null) {
        
        $file = $this->model->find($id);
        
        //Set default path to store files
        $basePath = $this->cleanPath(config('arane-file.disk.' . $file->disk . '.paths.default'));
        
        $toPath = isset($toPath) ? $toPath : $file->path;
        
        //return $file->path . $file->stored_id;
        
        if (Storage::disk($file->disk)->exists($file->path . $file->stored_id)) {
            
            $new_store_id = uniqid();
            
            Storage::disk($file->disk)->copy($file->path . $file->stored_id, $basePath . $this->cleanPath($toPath) . $new_store_id);
            
            $toPath = $this->cleanPath($toPath);
            
            isset($newName) ?: $newName = $file->name;
            
            return parent::create(['stored_id' => $new_store_id, 'name' => $newName, 'path' => $toPath, 'type' => $file->type, 'disk' => $file->disk]);
        }
        
        return null;
    }
    
    /**
     * Copy file on new directory and new name passed by request parameters, create a new file on the DB
     *
     * @param int $id
     * @param string $toPath
     * @param string $newName
     *
     * @return mixed
     */
    function move($id, $toPath, $newName=null) {
    
        $file = $this->model->find($id);
        
        //Set default path to store files
        $basePath = $this->cleanPath(config('arane-file.disk.' . $file->disk . '.paths.default'));
    
        $toPath = isset($toPath) ? $toPath : $file->path;
        
        if (Storage::disk($file->disk)->exists($file->path . $file->stored_id)) {
            
            Storage::disk($file->disk)->move($file->path . $file->stored_id, $basePath . $this->cleanPath($toPath) . $file->stored_id);
            
            $toPath = $this->cleanPath($toPath);
            
            isset($newName) ?: $newName = $file->name;
            
            parent::update($file->id, ['name' => $newName, 'path' => $toPath]);
            
            return $this->model->find($file->id);
        }
        
        return null;
    }
    
    
    //PRIVATE FUNCTIONS
    
    private function cleanPath($path) {
        return trim($path, '/') . '/';
    }
    
}
