<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    
    protected $table = 'parties';
    
    protected $fillable = [
        'full_name',
        'party_type',
        'phone_no',
        'address',
        'account_holder_name',
        'account_no',
        'bank_name',
        'ifsc_code',
        'branch_address',
        // other fields
    ];
    
    public function gstBills()
    {
        return $this->hasMany(GstBill::class);
    }
}
