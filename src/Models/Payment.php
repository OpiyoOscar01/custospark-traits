<?php

namespace Custospark\Traits\Models;
use Custospark\Traits\Models\Invoice;
use App\Models\User;
use Custospark\Traits\Models\Subscription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Payment.php

class Payment extends Model
{
    use HasFactory;
    protected $connection = 'auth_db';
    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'subscription_id', 'amount', 'currency', 'method',
        'status', 'transaction_id', 'paid_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

