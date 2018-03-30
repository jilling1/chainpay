<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('currencies')->insert([
                'id' => 1,
                'currency_code' => 'btc',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('currencies')->insert([
                'id' => 2,
                'currency_code' => 'doge',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('currencies')->insert([
                'id' => 3,
                'currency_code' => 'ltc',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        } catch (Exception $e) {
        }
    }
}
