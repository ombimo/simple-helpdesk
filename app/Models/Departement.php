<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
