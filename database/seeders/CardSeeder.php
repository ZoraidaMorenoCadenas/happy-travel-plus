<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;
use Illuminate\Support\Facades\Storage;


class CardSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $imagePath = public_path('images');
        $uploadedImagePath = Storage::putFile('public/storage', $imagePath);

        $cards = [
            [   'user_id' => 1,
                'image' => $imagePath, 
                'title' => 'imagepath',
                'location' => 'Puerto Rico',
                'description' => 'imagepath'
            ],
            
            [
                'user_id' => 2,
                'image' => $imagePath,
                'title' => 'Extreme travel',
                'location' => 'Everest',
                'description' => 'Snow and sport'
            ],

            [
                'user_id' => 2,
                'image' => Storage::url($uploadedImagePath),
                'title' => 'Romantic Vacation',
                'location' => 'Italia',
                'description' => 'storage::URL'
            ],
            [
                'user_id' => 2,
                'image' => 'http://127.0.0.1:8000/storage/images/bQ1Wgkhg9UpgKsOwXSLOWnkgJuoYQ9Ah68SOvYqJ.jpg',
                'title' => 'Safari de aventura',
                'location' => 'Kenia',
                'description' => 'hhtp'
            ],
            
            [
                'user_id' => 1,
                'image' => 'storage/images/bQ1Wgkhg9UpgKsOwXSLOWnkgJuoYQ9Ah68SOvYqJ.jpg',
                'title' => 'Escapada Soñada',
                'location' => 'Grecia',
                'description' => 'Todo es mejor en Grecia, donde el vino es más suave, las aguas son más claras y las puestas de sol son más intensas. Los viajeros nunca quieren irse'
            ],

            [
                'user_id' => 2,
                'image' => 'seed_images/07.jpg',
                'title' => 'Vacaciones en el Hielo',
                'location' => 'Antartida',
                'description' => 'Imagina una ballena emergiendo a tu lado para saludarte mientras los pingüinos brincan en la proa de tu bote cuando navegas junto a un iceberg en kayak. Esto es la Antártida'
            ],

            [
                'user_id' => 1,
                'image' => 'seed_images/10.jpg',
                'title' => 'Auroras Boreales y naturaleza',
                'location' => 'Islandia',
                'description' => 'Difícilmente hay un país en el mundo que luzca tantos paisajes trascendentales en tan poco tiempo. La belleza te atrae. La diversidad hace que nunca quieras irte'
            
            ],
            [
                'user_id' => 2,
                'image' => 'images/B70o7gcmIu5qCt1ESPiklWOzMJfN3ryflv5zJiHU.jpg',
                'title' => 'Playas paradisiacas y paz',
                'location' => 'Maldivas',
                'description' => 'Despertarse con el runrún del mar en su idílico bungaló en las Maldivas dará vida a la realidad tropical'
            ],
            [
                'user_id' => 1,
                'image' => 'images/B70o7gcmIu5qCt1ESPiklWOzMJfN3ryflv5zJiHU.jpg',
                'title' => 'Salto Angel, una maravilla natural',
                'location' => 'Venezuela',
                'description' => 'El Salto Ángel es una de las mayores atracciones turísticas de Venezuela. Su sola visión te dejará sin aliento. Una experiencia indescriptible que debes vivir'
            ],
            [
                'user_id' => 2,
                'image' => 'images/B70o7gcmIu5qCt1ESPiklWOzMJfN3ryflv5zJiHU.jpg',
                'title' => 'Islas Galapagos, el origen de las especies',
                'location' => 'Ecuador',
                'description' => 'Un viaje en el tiempo para entender por qué Darwin encontró su tierra de ensueño aquí. La flora y la fauna abundantes y las especies asombrosas dan color al ambiente en medio de la emoción de la aventura'
            ],

            [
                'user_id' => 1,
                'image' => 'images/B70o7gcmIu5qCt1ESPiklWOzMJfN3ryflv5zJiHU.jpg',
                'title' => 'Machu Pichu, tribus e historia',
                'location' => 'Perú',
                'description' => 'Pasear por el Camino Inca es un intenso viaje a siglos pasados y a las raíces de nuestra historia que permanecen vivas hasta el día de hoy'
            ]

            ];
          
       DB::table('cards')->insert($cards);
        
    }
}
