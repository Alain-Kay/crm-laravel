<?php

namespace App\Models;

use App\Traits\IsTenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Deal extends Model
{
    use HasFactory;
    use IsTenantModel;

    protected $fillable = [
        'name',
        'value',
        'stage',
        'close_date',
        'probability',
        'contact_id',
        'user_id',
        'pipeline_id',
        'stage_id',
    ];

    protected $casts = [
        'close_date' => 'date',
        'value' => 'decimal:2',
        'probability' => 'integer',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'activitable');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function pipeline(): BelongsTo
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function updateStage(Stage $newStage)
    {
        $this->stage()->associate($newStage);
        $this->save();
    }
}