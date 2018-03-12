<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $fillable = [
        'name',
        'end_date',
    ];

    /**
     * 1:n
     */
    public function project_type() {
        return $this->belongsTo('App\Models\ProjectType', 'project_type');
    }

    public function scopeWithProjectType($query) {
        return $query->with('project_type');
    }
}
