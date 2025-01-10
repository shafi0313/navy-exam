<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = array(
            array('rank_id' => 1, 'name' => 'বাংলা','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('rank_id' => 1, 'name' => 'ইংরেজি','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('rank_id' => 1, 'name' => 'গণিত','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('rank_id' => 1, 'name' => 'বিজ্ঞান','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('rank_id' => 1, 'name' => 'সাধারণ জ্ঞান ও বুদ্ধিমত্তা','created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL)
          );
        Subject::insert($subjects);
    }
}
