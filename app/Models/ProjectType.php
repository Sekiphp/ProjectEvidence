<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $table = "project_types";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function projects() {
        return $this->hasMany('App\Models\Project', 'project_type');
    }

}
