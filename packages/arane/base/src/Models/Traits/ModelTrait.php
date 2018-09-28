<?php

namespace Arane\Base\Models\Traits;

use Carbon\Carbon;
use Cookie;
use Auth;
use Session;
use ReflectionClass;
use App\Support\Arrays;

trait ModelTrait {

    public function className() {
        new ReflectionClass($this);
    }

    /**
     * Display timestamps in user's timezone
     */
    protected function asDateTime($value) {
        if ($value instanceof Carbon) {
            return $value;
        }


        $timezone = session()->get('user.timezone');

        if ($timezone !== '') {
            $value = parent::asDateTime($value);

            return $value->setTimezone($timezone);
        }

        return new Carbon($value);

    }

    public static function fillableFields() {
        return (new self)->getFillable();
    }

    public function sync($relationship, $column, array $values) {
        $new_values = array_filter($values);

        $old_values = $this->$relationship->pluck($column, 'id')->toArray();

        // Delete removed values, if any
        if ($deleted = Arrays::keysDeleted($new_values, $old_values)) {
            $this->$relationship()->whereIn('id', $deleted)->delete();
        }

        // Create new values, if any
        if ($created = Arrays::keysCreated($new_values, $old_values)) {
            foreach ($created as $id) {
                $new[] = $this->$relationship()->getModel()->newInstance([
                    $column => $new_values[$id],
                ]);
            }

            $this->$relationship()->saveMany($new);
        }

        // Update changed values, if any
        if ($updated = Arrays::keysUpdated($new_values, $old_values)) {
            foreach ($updated as $id) {
                $this->$relationship()->find($id)->update([
                    $column => $new_values[$id],
                ]);
            }
        }
    }

}