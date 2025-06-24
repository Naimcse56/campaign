<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    protected $guarded = ['id'];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class)->withDefault(['name' => 'N/A']);
    }

    public function formFields()
    {
        return $this->hasMany(CampaignFormField::class)->orderBy('order');
    }
}
