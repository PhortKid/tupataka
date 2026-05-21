<?php
/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CsvImportController extends Controller
{
    // Inafungua fomu ya HTML
    public function showForm()
    {
        return view('import_customers');
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $headers = fgetcsv($handle, 1000, ',');
        $headers = array_map('trim', $headers);

        $insertedCount = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $data = array_combine($headers, $row);

            $fullName = trim($data['customer']);
            $nameParts = explode(' ', $fullName, 3);
            $firstname = $nameParts[0] ?? '';
            $middlename = (count($nameParts) > 2) ? $nameParts[1] : '';
            $lastname = (count($nameParts) > 2) ? $nameParts[2] : ($nameParts[1] ?? '');

            // Look up ID kwa kutumia LIKE ili isizingue herufi kubwa au ndogo
            $regionId   = DB::table('region')->where('name', 'LIKE', trim($data['region_id']))->value('id');
            $districtId = DB::table('district')->where('name', 'LIKE', trim($data['district_id']))->value('id');
            $wardId     = DB::table('ward')->where('name', 'LIKE', trim($data['ward_id']))->value('id'); 
            $streetId   = DB::table('street')->where('name', 'LIKE', trim($data['street_id']))->value('id');

            Customer::create([
                'fullname_business_name' => trim($data['Biashara']),
                'firstname'             => $firstname,
                'middlename'            => $middlename,
                'lastname'              => $lastname,
                'phone_number'          => trim($data['phone_number']),
                'region_id'             => $regionId ?? null,
                'district_id'           => $districtId ?? null,
                'ward_id'               => $wardId ?? null,
                'street_id'             => $streetId ?? null,
                'business_activity_id'  => !empty($data['business_activity_id']) ? (int)$data['business_activity_id'] : null,
                'irregular_amount'      => !empty($data['Malipo']) ? $data['Malipo'] : 0.00,
                'status'                => 1,
                'is_confirmed'          => true,
            ]);

            $insertedCount++;
        }

        fclose($handle);

        // Rudisha ujumbe wa mafanikio kwenye view
        return redirect()->route('import.form')->with('success', "Hongera! Wateja {$insertedCount} wameingizwa kwenye database kikamilifu.");
    }
}*/



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CsvImportController extends Controller
{
    // Inafungua fomu ya HTML
    public function showForm()
    {
        return view('import_customers');
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $headers = fgetcsv($handle, 1000, ',');
        $headers = array_map('trim', $headers);

        $insertedCount = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $data = array_combine($headers, $row);

            $fullName = trim($data['customer']);
            $nameParts = explode(' ', $fullName, 3);
            $firstname = $nameParts[0] ?? '';
            $middlename = (count($nameParts) > 2) ? $nameParts[1] : '';
            $lastname = (count($nameParts) > 2) ? $nameParts[2] : ($nameParts[1] ?? '');

            // Look up ID kwa kutumia LIKE ili isizingue herufi kubwa au ndogo
            $regionId   = DB::table('region')->where('name', 'LIKE', trim($data['region_id']))->value('id');
            $districtId = DB::table('district')->where('name', 'LIKE', trim($data['district_id']))->value('id');
            $wardId     = DB::table('ward')->where('name', 'LIKE', trim($data['ward_id']))->value('id'); 
            
                // 1. Tafuta kama mtaa upo
                $streetName = trim($data['street_id']);
                $streetId   = DB::table('street')->where('name', 'LIKE', $streetName)->value('id');

                // 2. Kama haupo na jina haliko wazi, usajili palepale zikiwemo ID zote tatu
                if (!$streetId && !empty($streetName)) {
                    $streetId = DB::table('street')->insertGetId([
                        'name'        => $streetName,
                        'ward_id'     => $wardId ?? null,
                        'district_id' => $districtId ?? null,
                        'region_id'   => $regionId ?? null, // <<< ONGEZA HII LINE ILI KUONDOA ERROR
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }

            Customer::create([
                'fullname_business_name' =>  trim($data['customer']),
                'firstname'             => $firstname,
                'middlename'            => $middlename,
                'lastname'              => $lastname,
                'phone_number'          => '255'.trim($data['phone_number']),
                'region_id'             => $regionId ?? null,
                'district_id'           => $districtId ?? null,
                'ward_id'               => $wardId ?? null,
                'street_id'             => $streetId ?? null, // Sasa hapa itapokea ID ya mtaa wa zamani au uliosajiliwa upya
                'business_activity_id'  => !empty($data['business_activity_id']) ? (int)$data['business_activity_id'] : null,
                'irregular_amount'      => !empty($data['Malipo']) ? $data['Malipo'] : 0.00,
                'status'                => 1,
                'is_confirmed'          => false,
            ]);

            $insertedCount++;
        }

        fclose($handle);

        // Rudisha ujumbe wa mafanikio kwenye view
        return redirect()->route('import.form')->with('success', "Hongera! Wateja {$insertedCount} wameingizwa kwenye database kikamilifu.");
    }
}