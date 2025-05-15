<?php
// app/Models/Feature.php

namespace Custospark\Traits\Models;
use Custospark\Traits\Models\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $connection = 'auth_db';
    protected $table = 'features';
    protected $primaryKey = 'id';

    protected $fillable = [
        'app_id',
        'name',
        'code',
        'description',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function plans()
{
    return $this->belongsToMany(Plan::class, 'feature_plans')
                ->withPivot('value')
                ->withTimestamps();
}

}

