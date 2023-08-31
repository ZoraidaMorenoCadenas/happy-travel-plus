<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       /* $imagePath = public_path('storage/images/bQ1Wgkhg9UpgKsOwXSLOWnkgJuoYQ9Ah68SOvYqJ.jpg');
        // Subir la imagen al sistema de archivos de Laravel
        $uploadedImagePath = Storage::putFile('public/images', $imagePath);*/
        
    
        $destinations = [
            [   'image' => "http://127.0.0.1:8000/storage/images/01.jpg",
                'title' => 'StorageURL',
                'location' => 'Puerto Rico',
                'description' => 'storage URL'
            ],
            
            [   
                'image' => "http://127.0.0.1:8000/storage/images/02.jpg",
                'title' => 'Extreme travel',
                'location' => 'Everest',
                'description' => 'Snow and sport'
            ],

            [
                
                'image' => "http://127.0.0.1:8000/storage/images/03.jpg",
                'title' => 'Romantic Vacation',
                'location' => 'Italia',
                'description' => 'storage::URL'
            ],
            [
               
                'image' => 'http://127.0.0.1:8000/storage/images/04.jpg',
                'title' => 'Safari de aventura',
                'location' => 'Kenia',
                'description' => 'hhtp'
            ],
            
            [
                
                'image' => 'http://127.0.0.1:8000/storage/images/05.jpg',
                'title' => 'Escapada Soñada',
                'location' => 'Grecia',
                'description' => 'URL las puestas de sol son más intensas. Los viajeros nunca quieren irse'
            ],

            [
               
                'image' => 'http://127.0.0.1:8000/storage/images/06.jpg',
                'title' => 'Vacaciones en el Hielo',
                'location' => 'Antartida',
                'description' => 'Imagina una ballena emergiendo a tu lado para saludarte mientras los pingüinos brincan en la proa de tu bote cuando navegas junto a un iceberg en kayak. Esto es la Antártida'
            ],

            [
                
                'image' => 'http://127.0.0.1:8000/storage/images/07.jpg',
                'title' => 'Auroras Boreales y naturaleza',
                'location' => 'Islandia',
                'description' => 'Difícilmente hay un país en el mundo que luzca tantos paisajes trascendentales en tan poco tiempo. La belleza te atrae. La diversidad hace que nunca quieras irte'
            
            ],
            [
                
                'image' => 'http://127.0.0.1:8000/storage/images/08.jpg',
                'title' => 'Auroras Boreales y naturaleza',
                'location' => 'Islandia',
                'description' => 'Difícilmente hay un país en el mundo que luzca tantos paisajes trascendentales en tan poco tiempo. La belleza te atrae. La diversidad hace que nunca quieras irte'
            
            ]
           

            ];
          
       DB::table('destinations')->insert($destinations);
        //
    }
}
