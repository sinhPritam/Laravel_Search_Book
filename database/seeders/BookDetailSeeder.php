<?php

namespace Database\Seeders;

use App\Models\BookDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class BookDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $client = new Client();
        $res = $client->get('https://fakerapi.it/api/v1/books?_quantity=100');
        $response = json_decode($res->getBody()->getContents(), TRUE);
        BookDetail::insert($response['data']);
    }
}
