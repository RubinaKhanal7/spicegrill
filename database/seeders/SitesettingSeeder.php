<?php

namespace Database\Seeders;

use App\Models\Sitesetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SitesettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sitesetting::create([
            'govn_name' => 'Aasha Tech',
            'ministry_name' => 'Aasha Tech',
            'department_name' => 'Aasha Tech',
            'office_name' => 'Aasha Tech',
            'office_address' => 'Sinamangal, Kathmandu',
            'office_contact' => '+9774596538',
            'office_mail' => 'info.aashatech@gmail.com',
            'main_logo' => 'main_logo.png',
            'side_logo' => 'main_logo.png',
            'face_link' => 'https://www.facebook.com/narayankaji.shrestha.33/',
            'insta_link' => 'https://www.instagram.com/shresthanarayankaji/',
            'social_link' => 'https://twitter.com/nksthaprakash?ref_src=twsrc%5Etfw',
            'linked_link' => 'https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FShresthaNarayanKaji&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId',
            'google_maps' => 'https://www.googlemaps.com',


        ]);
    }
}
