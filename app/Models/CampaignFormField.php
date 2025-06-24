<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignFormField extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['options' => 'array'];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class)->withDefault(['name' => 'N/A']);
    }
}
