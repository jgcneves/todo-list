<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function setStatusAttribute($value)
    {
        if (!$value instanceof TaskStatus) {
            $value = TaskStatus::from((bool)$value);
        }

        $this->attributes['status'] = $value->value;
    }

    public function getStatusAttribute($value): TaskStatus
    {
        return TaskStatus::from($value);
    }

}
