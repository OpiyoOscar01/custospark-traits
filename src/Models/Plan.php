<?php
namespace Custospark\Traits\Models;
use Custospark\Traits\Models\App;
use Custospark\Traits\Models\Feature;
use Custospark\Traits\Models\Subscription;
use Custospark\Traits\Models\Role;
use Custospark\Traits\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $connection = 'auth_db';
    protected $table = 'plans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'app_id',
        'name',
        'slug',
        'price',
        'billing_cycle',
        'description',
        'is_popular',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_plans')
                    ->withPivot('value')
                    ->withTimestamps();
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
