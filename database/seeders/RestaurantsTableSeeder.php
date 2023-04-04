<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $category_id = Category::whereIn('id', [1,4])->pluck('id')->toArray();
                Restaurant::create([

                    'name' => 'Ristorante da Francesco',
                    'image' => 'https://www.mongalletto.it/wp-content/uploads/2016/10/ristorante-terrazza.jpg',
                    'vat' => '12345678901',
                    'address' => 'Via Roma, 1',
                    'user_id' => 1,
                    ])->categories()->attach($category_id);
        
                

                $category_id = Category::find(3)->id;
                Restaurant::create([
                    'name' => 'Ristorante da Paolo',
                    'image' => 'https://www.lerocce.com/wp-content/uploads/2019/01/terrazza_ulivi.jpg',
                    'vat' => '56345348901',
                    'address' => 'Via Roma, 2',
                    'user_id' => 2,

                ])->categories()->attach($category_id);
                
                $category_id = Category::whereIn('id', [3, 5, 6])->pluck('id')->toArray();
                Restaurant::create([
                   'name' => 'Ristorante da Matteo',
                   'image' => 'https://media-magazine.trivago.com/agriturismo-con-spa-umbria-borgomandoleto-esterno.jpg',
                   'vat' => '99996348901',
                   'address' => 'Via Roma, 3',
                   'user_id' => 3,
                   ])->categories()->attach($category_id);

                $category_id = Category::find(9)->id;
                Restaurant::create([
                    'name' => 'Ristorante da Luiggina',
                    'image' => 'https://agriturismocaiferri.it/wp-content/uploads/2022/06/IMG-20220627-WA0004.jpg',
                    'vat' => '66445348901',
                    'address' => 'Via Roma, 4',
                    'user_id' => 4,
                ])->categories()->attach($category_id);
           
                $category_id = Category::whereIn('id', [4, 6, 2])->pluck('id')->toArray();
                Restaurant::create([
                    'name' => 'Ristorante da Giorgia',
                    'image' => 'https://www.ristorantemovida.it/wp-content/uploads/2020/10/ristorante_movida_bg-home_2.jpg',
                    'vat' => '56374659801',
                    'address' => 'Via Roma, 5',
                    'user_id' => 5,
                ])->categories()->attach($category_id);

                //Ristoranti nuovi

                $category_id = Category::whereIn('id', [1,4])->pluck('id')->toArray();
                Restaurant::create([

                    'name' => 'Ristorante da Gabriella',
                    'image' => 'https://www.peruca.eu/wp-content/uploads/2021/02/Peruca-sala-sito-col.jpg',
                    'vat' => '12345678901',
                    'address' => 'Via Roma, 6',
                    'created_at' => '2023/02/12 11:20:45',
                    'updated_at' => '2023/02/12 11:20:45',
                    'user_id' => 6,
                    ])->categories()->attach($category_id);
        
                

                $category_id = Category::find(1)->id;
                Restaurant::create([
                    'name' => 'Ristorante da Luca',
                    'image' => 'https://media-assets.lacucinaitaliana.it/photos/61fb0393f9bff304ce3ec288/16:9/w_2560%2Cc_limit/Il-meglio-del-lago-di-Orta.jpg',
                    'vat' => '56345348901',
                    'address' => 'Via Roma, 7',
                    'created_at' => '2023/01/12 11:20:45',
                    'updated_at' => '2023/01/12 11:20:45',
                    'user_id' => 7,

                ])->categories()->attach($category_id);
                
                $category_id = Category::whereIn('id', [3, 5, 6])->pluck('id')->toArray();
                Restaurant::create([
                   'name' => 'Ristorante da Biagio',
                   'image' => 'https://www.ristorantesole.com/wp-content/uploads/2021/08/ristorante-del-sole-living-caffe%CC%80-terrazza-locale-interno-perugia-mangiare.jpg',
                   'vat' => '99996348901',
                   'address' => 'Via Roma, 8',
                   'created_at' => '2023/01/12 11:20:45',
                    'updated_at' => '2023/01/12 11:20:45',
                   'user_id' => 8,
                   ])->categories()->attach($category_id);

                $category_id = Category::find(10)->id;
                Restaurant::create([
                    'name' => 'Ristorante da Lucio',
                    'image' => 'https://ristorantemaestrale.com/wp-content/uploads/2019/10/locale.jpg',
                    'vat' => '66445348901',
                    'address' => 'Via Roma, 9',
                    'created_at' => '2023/01/12 11:20:45',
                    'updated_at' => '2023/01/12 11:20:45',
                    'user_id' => 9,
                ])->categories()->attach($category_id);
           
                $category_id = Category::whereIn('id', [4, 6, 2])->pluck('id')->toArray();
                Restaurant::create([
                    'name' => 'Ristorante da Davide',
                    'image' => 'https://media.z-suite.it/grandhotelcourmayeurmontblanc.it/public/Ristorante/2014_12_GHCM_ristorante10.jpg',
                    'vat' => '56374659801',
                    'address' => 'Via Roma, 10',
                    'created_at' => '2023/01/12 11:20:45',
                    'updated_at' => '2023/01/12 11:20:45',
                    'user_id' => 10,
                ])->categories()->attach($category_id);
                
                $category_id = Category::whereIn('id', [4, 6, 2])->pluck('id')->toArray();
                Restaurant::create([
                    'name' => 'Ristorante da Tomas',
                    'image' => 'http://fevaristorante.it/images/feva/home_feva-ristorante_sala2.jpg',
                    'vat' => '56374659801',
                    'address' => 'Via Roma, 10',
                    'created_at' => '2023/01/12 11:20:45',
                    'updated_at' => '2023/01/12 11:20:45',
                    'user_id' => 11,
                ])->categories()->attach($category_id);
                        
    }
}