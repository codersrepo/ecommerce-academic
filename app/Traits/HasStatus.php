<?php

namespace App\Traits;


trait HasStatus
{
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function toggleStatus()
    {
        $status = $this->isActive() ? 'inactive' : 'active';

        $this->update(compact('status'));
    }

    public function setToInactive()
    {
        $this->update(['status' => 'inactive']);
    }

    public function scopeActive($q)
    {
        $q->where('status', 'active');
    }
}
