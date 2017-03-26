<?php

namespace App\TheShots\Traits;

trait ModelHelpers
{
    public function hasRelation ($relation)
    {
        if(isset($this->relations[$relation])) {
            return true;
        }
        return false;
    }

    /**
     * Return a created at for humans or error.
     */
    public function getTimeAttribute ()
    {
        if($this->created_at) {
            return [
                'original' => $this->created_at->toDateTimeString(),
                'diff' => $this->created_at->diffForHumans(),
            ];
        }
        return 'Time not specifed';
    }
}