<?php

namespace Arane\Base\Services\Handlers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;

use Illuminate\Routing\Controller;
use Prophecy\Exception\Doubler\ClassNotFoundException;
use ReflectionClass;

/**
 * Class BaseModelService
 *
 * @package namespace Arane\Base\Services\Handlers;
 */
abstract class BaseModelService extends Controller {
    
    /**
     * @var
     */
    public $model;
    /**
     *
     * /**
     * @var int
     */
    protected $pageLimit;
    
    /**
     * BaseModelService constructor.
     *
     
     */
    public function __construct() {
        $model = self::makeModel();
        $this->model = new $model;
        
        $this->pageLimit = 20;
    }
    
    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id) {
        $found = $this->model->find($id);
        if (!isset($found)) {
            throw new ModelNotFoundException("No record found with id {$id}");
        }
        
        return $found;
    }
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();
    
    /**
     * @return array
     */
    public function shown() {
        return isset($this->model->shown) ? $this->model->shown : [];
    }
    
    /**
     * @return Model
     */
    public function makeModel() {
        $model = resolve($this->model());
        
        if (!$model instanceof Model) {
            throw new ClassNotFoundException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model", $this->model());
        }
        
        return $this->model = $model;
    }
    
    /**
     * Store a newly created resource.
     *
     * @param  array $attributes
     *
     * @return Model
     *
     */
    
    public function create($attributes) {
        
        return $this->model->create($attributes);
    }
    
    /**
     * Update the specified resource.
     *
     * @param  array       $attributes
     * @param  array | int $id
     *
     * @return int
     */
    public function update($id, $attributes, $notFoundCreate = false, $noException = false) {
        
        $id = is_array($id) ? $id : [$id];
        
        if (count($id) === 1 && $notFoundCreate) {
            
            return $this->model->updateOrCreate(['id' => $id[0]], $attributes);
            
        } else {
            if ($this->model->whereIn('id', $id)->count()) {
                
                return $this->model->whereIn('id', $id)->update($attributes);
                
            } else {
                if (!$noException) {
                    throw new ModelNotFoundException('No records found with provided id');
                }
            }
        }
        
        return 0;
    }
    
    
    /**
     * Remove the specified resource.
     *
     * @param  array | int $id
     *
     * @return int
     */
    public function delete($id, $trashed = false) {
        
        $id = is_array($id) ? $id : [$id];
        
        $deleteQuery = $trashed ? $this->model->onlyTrashed() : $this->model;
        
        if ($deleteQuery->whereIn('id', $id)->count()) {
            
            if ($trashed) {
                return $deleteQuery->whereIn('id', $id)->forceDelete();
            }
            
            return $deleteQuery->whereIn('id', $id)->delete();
            
        } else {
            throw new ModelNotFoundException('No records found with provided id');
        }
    }
    
    /**
     * Restore the specified resource.
     *
     * @param  int $id
     *
     * @return int
     */
    public function restore($id) {
        
        $id = is_array($id) ? $id : [$id];
        
        if ($this->model->onlyTrashed()->whereIn('id', $id)->count()) {
            
            return $this->model->onlyTrashed()->whereIn('id', $id)->restore();
            
        } else {
            throw new ModelNotFoundException('No records found with provided id');
        }
    }
    
    
    /** Returns records matching specified $options conditions
     *
     * @param array $options
     *
     * @return mixed
     *
     * Search & list model records.
     *  **Parameter $request['options']:**
     *  - id                   => id or array of ids to retrieve
     *  - columns [array]      => columns to return
     *  - order [string|array] => specify order with string like 'criteria:direction'
     *  - limit [int]          => specify page items limit
     *  - no-paginate [bool]   => specify to not paginate results
     *  - scope [string]       => specify item status: deleted, active, all (active + deleted)
     *  - conditions [array]   => searching conditions (see explanation)
     *
     *    **Conditions syntax** =>  join @ condition ... | condition
     *    - Single Condition syntax  => column : value : operator
     *      - column (required)      => column to search
     *      - value (required)       => value to compare
     *      - operator (optional)    => operator to apply (default =, like, <, >, <=, >=)
     *    - Join operator (optional) => and @, or @
     *
     *    **Condition example**: Search for (model with column_name == 'value') OR (other_column_name like %-value%)
     *    - column_name : 'value' | or @ other_column_name : %-value% : like
     */
    
    public function searchQuery($options = []) {
        
        //get service model
        $query = $this->model;
        
        //process find or get by id
        if (isset($options['id'])) {
            $id = is_array($options['id']) ? $options['id'] : [$options['id']];
            $query = $query->whereIn('id', $id);
        }
        
        //process order (criteria and direction)
        if (isset($options['order'])) {
            $orders = is_array($options['order']) ? $options['order'] : [$options['order']];
            foreach ($orders as $order) {
                $order = explode(':', $order);
                $orderColumn = $order[0];
                $orderDirection = isset($order[1]) ? $order[1] : 'desc';
                $query = $query->orderBy($orderColumn, $orderDirection);
            }
        }
        
        
        //process conditions (where)
        if (isset($options['conditions'])) {
            $conditionsList = is_array($options['conditions']) ? $options['conditions'] : [$options['conditions']];
            
            $andConditions = [];
            $orConditions = [];
            
            foreach ($conditionsList as $conditions) {
                $conditions = explode('@', $conditions);
                if (count($conditions) > 1) {
                    if (strcasecmp($conditions[0], 'or') === 0) {
                        $orConditions[] = $conditions[1];
                    } else {
                        $andConditions[] = $conditions[1];
                    }
                } else {
                    $andConditions[] = $conditions[0];
                }
            }
            
            //process AND conditions
            foreach ($andConditions as $conditions) {
                $query = $query->where(function ($query) use ($conditions) {
                    $conditions = explode('|', $conditions);
                    
                    foreach ($conditions as $condition) {
                        $condition = explode(':', $condition);
                        $conditionColumn = $condition[0];
                        $conditionValue = $condition[1];
                        $conditionOperator = isset($condition[2]) ? $condition[2] : '=';
                        if ($conditionOperator === 'like') {
                            if (is_numeric($conditionValue)) {
                                $conditionOperator = '=';
                            } else {
                                $conditionValue = "%{$conditionValue}%";
                            }
                        }
                        $query = $query->where($conditionColumn, $conditionOperator, $conditionValue);
                    }
                    
                });
            }
            
            //process OR conditions
            foreach ($orConditions as $conditions) {
                $query = $query->orWhere(function ($query) use ($conditions) {
                    $conditions = explode('|', $conditions);
                    
                    foreach ($conditions as $condition) {
                        $condition = explode(':', $condition);
                        $conditionColumn = $condition[0];
                        $conditionValue = $condition[1];
                        $conditionOperator = isset($condition[2]) ? $condition[2] : '=';
                        if ($conditionOperator === 'like') {
                            if (is_numeric($conditionValue)) {
                                $conditionOperator = '=';
                            } else {
                                $conditionValue = "{$conditionValue}";
                            }
                        }
                        $query = $query->where($conditionColumn, $conditionOperator, $conditionValue);
                    }
                });
            }
            
        }
        
        //process by entity status (deleted or not)
        if (isset($options['scope'])) {
            switch ($options['scope']) {
                case 'deleted' :
                    $query = $query->onlyTrashed();
                    break;
                
                case 'all':
                    $query = $query->withTrashed();
                    break;
            }
        }
        
        //process relationships
        if (isset($options['relationships'])) {
            $relationships = is_array($options['relationships']) ? $options['relationships'] : [$options['relationships']];
            
            return $query = $query->with($relationships);
        }
        
        return $query;
    }
    
    /**
     * @param array $options
     *
     * @return mixed
     */
    public function search($options = []) {
        
        $query = $this->searchQuery($options);
        
        if (isset($options['no-paginate']) && $options['no-paginate']) {
            $result = $this->searchQuery($options);
            
            if (isset($options['columns'])) {
                $columns = array_unique(array_merge($this->shown(), $options['columns']));
                
                return $result->get($columns);
            }
            
            return $result->get();
            
        } else {
            
            $limit = isset($options['limit']) && intval($options['limit']) > 0 ? $options['limit'] : $this->pageLimit;
            
            return $query->paginate($limit);
        }
        
    }
    
    /**
     * @param $keyColumn
     * @param $valueColumn
     * @param $textColumn
     *
     * @return mixed
     */
    public function listAsOptions($keyColumn, $valueColumn, $textColumn) {
        
        return $this->model->select("$keyColumn as key", "$valueColumn as value", "$textColumn as text")->get();
    }
    
    
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $method
     *
     * @return mixed
     */
    function learnMethodType(Model $model, string $method) {
        try {
            $oReflectionClass = new ReflectionClass($model);
            $method = $oReflectionClass->getMethod($method);
            $type = get_class($method->invoke($model));
            
            return (new ReflectionClass($type))->getShortName();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     * Synchronizes a model relationship with related array of model objects
     *
     * @param string $relation
     * @param mixed  $related
     *
     * @return string
     */
    public function syncRelationship(Model $model, string $relation, $related) {
        
        $relationType = $this->learnMethodType($model, $relation);
        
        switch ($relationType) {
            case 'BelongsTo':
                $model->{$relation}()->associate($related);
                
                return true;
                break;
            case 'HasMany':
            case 'HasOne':
            case 'HasManyThrough':
            case 'MorphOne':
            case 'MorphMany':
                $model->{$relation}()->delete();
                $model->{$relation}()->saveMany($related);
                
                return true;
                
                break;
            case 'BelongsToMany':
                $model->{$relation}()->sync($related);
                
                return true;
                break;
            default:
                throw new RelationNotFoundException('Relation ' . $relation . ' type ' . $relationType . ' not found');
        }
    }
    
    
}
