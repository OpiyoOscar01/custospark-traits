<?php
// app/Models/Invoice.php

namespace Custospark\Traits\Models;
use Custospark\Traits\Models\Payment;
use App\Models\User;
use Custospark\Traits\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
      protected $connection = 'auth_db';
    protected $table = 'invoices';
    protected $primaryKey = 'id';


    protected $fillable = [
        'subscription_id',
        'user_id',
        'amount',
        'status',
        'issued_at',
        'due_at',
        'payment_id',
        'pdf_url',
    ];

    /**
     * Get the subscription associated with the invoice.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the user associated with the invoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment associated with the invoice.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

