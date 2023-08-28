<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;


class CardSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cards = [
            [
                'image' => file_get_contents(public_path('/images/01.jpg')), 
                'title' => 'Fun Vacation',
                'location' => 'Puerto Rico',
                'description' => 'Playa, sol y Arena'
            ],
            
            [
                'image' => file_get_contents(public_path('/images/02.jpg')),
                'title' => 'Extreme travel',
                'location' => 'Everest',
                'description' => 'Snow and sport'
            ],

            [
                'image' => file_get_contents(public_path('/images/03.jpg')),
                'title' => 'Romantic Vacation',
                'location' => 'Italia',
                'description' => 'Pizza, ice cream'
            ],
            [
                'image' => file_get_contents(public_path('/images/04.jpg')),
                'title' => 'Safari de aventura',
                'location' => 'Kenia',
                'description' => 'Sientes la llamada de la naturaleza mientras elefantes y leones vagan libremente a tu alrededor. Esta experiencia vale absolutamente la pena cada segundo y una aventura para toda la vida'
            ],
            
            [
                'image' => file_get_contents(public_path('/images/05.jpg')),
                'title' => 'Escapada Soñada',
                'location' => 'Grecia',
                'description' => 'Todo es mejor en Grecia, donde el vino es más suave, las aguas son más claras y las puestas de sol son más intensas. Los viajeros nunca quieren irse'
            ],

            [
                'image' => file_get_contents(public_path('/images/06.jpg')),
                'title' => 'Vacaciones en el Hielo',
                'location' => 'Antartida',
                'description' => 'Imagina una ballena emergiendo a tu lado para saludarte mientras los pingüinos brincan en la proa de tu bote cuando navegas junto a un iceberg en kayak. Esto es la Antártida'
            ],

            [
                'image' => file_get_contents(public_path('/images/07.jpg')),
                'title' => 'Auroras Boreales y naturaleza',
                'location' => 'Islandia',
                'description' => 'Difícilmente hay un país en el mundo que luzca tantos paisajes trascendentales en tan poco tiempo. La belleza te atrae. La diversidad hace que nunca quieras irte'
            
            ],
            [
                'image' => file_get_contents(public_path('/images/08.jpg')),
                'title' => 'Playas paradisiacas y paz',
                'location' => 'Maldivas',
                'description' => 'Despertarse con el runrún del mar en su idílico bungaló en las Maldivas dará vida a la realidad tropical'
            ],
            [
                'image' => file_get_contents(public_path('/images/09.jpg')),
                'title' => 'Salto Angel, una maravilla natural',
                'location' => 'Venezuela',
                'description' => 'El Salto Ángel es una de las mayores atracciones turísticas de Venezuela. Su sola visión te dejará sin aliento. Una experiencia indescriptible que debes vivir'
            ],
            [
                'image' => file_get_contents(public_path('/images/10.jpg')),
                'title' => 'Islas Galapagos, el origen de las especies',
                'location' => 'Ecuador',
                'description' => 'Un viaje en el tiempo para entender por qué Darwin encontró su tierra de ensueño aquí. La flora y la fauna abundantes y las especies asombrosas dan color al ambiente en medio de la emoción de la aventura'
            ],

            [
                'image' => file_get_contents(public_path('/images/11.jpg')),
                'title' => 'Machu Pichu, tribus e historia',
                'location' => 'Perú',
                'description' => 'Pasear por el Camino Inca es un intenso viaje a siglos pasados y a las raíces de nuestra historia que permanecen vivas hasta el día de hoy'
            ]

            ];
          

        /*foreach ($cards as $card) {
            DB::table('cards')->insert($card);*/

        DB::table('cards')->insert($cards);
        
    }
}
