<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportingTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reporting_teacher')->insert(['teacher_name' => 'Katie']);
        DB::table('reporting_teacher')->insert(['teacher_name' => 'Max']);
    }
}
