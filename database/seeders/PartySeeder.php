<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Party;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add sample parties
        Party::create([
            'full_name' => 'ABC Company',
            'phone_no' => '9876543210',
            'address' => '123 Main Street, City',
            'party_type' => 'client',
            'account_holder_name' => 'ABC Company',
            'account_no' => '1234567890',
            'bank_name' => 'State Bank of India',
            'ifsc_code' => 'SBIN0001234',
            'branch_address' => 'Main Branch, City',
        ]);

        Party::create([
            'full_name' => 'XYZ Pvt Ltd',
            'phone_no' => '8765432109',
            'address' => '456 Market Road, City',
            'party_type' => 'vendor',
            'account_holder_name' => 'XYZ Pvt Ltd',
            'account_no' => '9876543210',
            'bank_name' => 'HDFC Bank',
            'ifsc_code' => 'HDFC0005678',
            'branch_address' => 'Market Branch, City',
        ]);

        Party::create([
            'full_name' => 'PQR Enterprises',
            'phone_no' => '7654321098',
            'address' => '789 Industrial Area, City',
            'party_type' => 'employee',
            'account_holder_name' => 'PQR Enterprises',
            'account_no' => '1122334455',
            'bank_name' => 'ICICI Bank',
            'ifsc_code' => 'ICIC0009876',
            'branch_address' => 'Industrial Branch, City',
        ]);
    }
}