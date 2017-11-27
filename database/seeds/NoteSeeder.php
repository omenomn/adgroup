<?php

use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 6; $i++) {
        	Note::create([
        		'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
        	]);
        }
    }
}
