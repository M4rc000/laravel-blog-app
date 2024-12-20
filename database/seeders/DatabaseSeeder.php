<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'Marco Antonio',
            'picture' => 'default.jpg',
            'username' => 'mrcantnio',
            'gender' => 'Male',
            'email' => 'marcoantoniomadgaskar@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        
        User::create([
            'name' => 'Kezya Ester',
            'picture' => 'default.jpg',
            'username' => 'kezyster',
            'gender' => 'Female',
            'email' => 'kezyaester@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        
        // User::factory(8)->create();
        
        Post::create([
            'title' => 'Superman',
            'picture' => 'post-img/superman.jpg',
            'category_id' => 1,
            'user_id' => 1,
            'visibility' => 'Public',
            'slug' => 'superman',
            'exerpt' => 'Superman, seorang bayi dari planet Krypton, dikirim ke Bumi sebelum planetnya hancur.',
            'body' => 'Superman, seorang bayi dari planet Krypton, dikirim ke Bumi sebelum planetnya hancur. Dibesarkan oleh pasangan petani di Smallville, ia tumbuh dengan kekuatan luar biasa akibat paparan Matahari Bumi. Sebagai Clark Kent, ia bekerja sebagai jurnalis di Daily Planet, namun sebagai Superman, ia melindungi dunia dari ancaman seperti Lex Luthor dan alien jahat lainnya.'
        ]);
            
        Post::create([
            'title' => 'Batman',
            'picture' => 'post-img/Batman.webp',
            'category_id' => 2,
            'user_id' => 1,
            'visibility' => 'Public',
            'slug' => 'batman',
            'exerpt' => 'Setelah menyaksikan pembunuhan orang tuanya di Gotham City, Bruce Wayne bersumpah untuk memerangi kejahatan.',
            'body' => 'Setelah menyaksikan pembunuhan orang tuanya di Gotham City, Bruce Wayne bersumpah untuk memerangi kejahatan. Dengan kekayaan dan kecerdasan luar biasa, ia menciptakan identitas Batman, lengkap dengan alat canggih dan pelatihan bela diri. Ia menghadapi musuh seperti Joker, Penguin, dan Bane, berusaha membawa keadilan tanpa membunuh.'
        ]);
        
        Post::create([
            'title' => 'Spider-Man',
            'picture' => 'post-img/spiderman.jfif',
            'category_id' => 3,
            'user_id' => 2,
            'visibility' => 'Private',
            'slug' => 'spider-man',
            'exerpt' => 'Peter Parker, seorang remaja kutu buku, digigit laba-laba radioaktif yang memberinya kekuatan super seperti memanjat tembok dan indra laba-laba.',
            'body' => 'Peter Parker, seorang remaja kutu buku, digigit laba-laba radioaktif yang memberinya kekuatan super seperti memanjat tembok dan indra laba-laba. Setelah kematian pamannya, ia belajar bahwa "dengan kekuatan besar datang tanggung jawab besar." Ia melawan musuh seperti Green Goblin dan Dr. Octopus sambil menyeimbangkan hidupnya sebagai siswa dan pahlawan.'
        ]);
        
        Post::create([
            'title' => 'Wonder Woman',
            'picture' => 'post-img/wonderwoman.jfif',
            'category_id' => 4,
            'user_id' => 2,
            'visibility' => 'Public',
            'slug' => 'wonder-woman',
            'exerpt' => 'Diana, seorang putri Amazon dari pulau Themyscira, meninggalkan rumahnya untuk menyelamatkan dunia dari kehancuran selama Perang Dunia I.',
            'body' => 'Diana, seorang putri Amazon dari pulau Themyscira, meninggalkan rumahnya untuk menyelamatkan dunia dari kehancuran selama Perang Dunia I. Sebagai Wonder Woman, ia menggunakan kekuatan, kebijaksanaan, dan senjata magis seperti Lasso of Truth untuk melawan musuh yang berusaha menghancurkan umat manusia.'
        ]); 
        
        Post::create([
            'title' => 'Iron Man',
            'picture' => 'post-img/ironman.jfif',
            'category_id' => 5,
            'user_id' => 2,
            'visibility' => 'Public',
            'slug' => 'iron-man',
            'exerpt' => 'Tony Stark, seorang genius teknologi dan miliarder, menciptakan armor bertenaga tinggi untuk menyelamatkan hidupnya setelah disandera.',
            'body' => 'Tony Stark, seorang genius teknologi dan miliarder, menciptakan armor bertenaga tinggi untuk menyelamatkan hidupnya setelah disandera. Setelah itu, ia terus menyempurnakan armornya untuk melawan ancaman global seperti Mandarin dan Thanos, sambil menghadapi masalah pribadi seperti alkoholisme dan krisis identitas.'
        ]);

        Post::create([
            'title' => 'The Flash',
            'picture' => 'post-img/theflash.jfif',
            'category_id' => 1,
            'user_id' => 1,
            'visibility' => 'Private',
            'slug' => 'the-flash',
            'exerpt' => 'Barry Allen, seorang ilmuwan forensik, mendapatkan kecepatan super setelah tersambar petir.',
            'body' => 'Barry Allen, seorang ilmuwan forensik, mendapatkan kecepatan super setelah tersambar petir di laboratoriumnya. Sebagai The Flash, ia menggunakan kecepatan tersebut untuk melawan penjahat seperti Reverse Flash dan Captain Cold, sambil berusaha menjaga keseimbangan antara pekerjaannya dan tanggung jawab sebagai pahlawan.'
        ]);
        
        Post::create([
            'title' => 'Captain America',
            'picture' => 'post-img/captainamerica.jfif',
            'category_id' => 1,
            'user_id' => 2,
            'visibility' => 'Public',
            'slug' => 'captain-america',
            'exerpt' => 'Steve Rogers, seorang pemuda lemah, menjadi simbol harapan setelah menerima serum super-soldier.',
            'body' => 'Steve Rogers, seorang pemuda lemah dari Brooklyn, menerima serum super-soldier yang memberinya kekuatan fisik luar biasa. Sebagai Captain America, ia memimpin perjuangan melawan Nazi dan organisasi jahat seperti Hydra selama Perang Dunia II dan era modern.'
        ]);
        
        Post::create([
            'title' => 'Doctor Strange',
            'picture' => 'post-img/doctorstrange.jfif',
            'category_id' => 4,
            'user_id' => 1,
            'visibility' => 'Public',
            'slug' => 'doctor-strange',
            'exerpt' => 'Stephen Strange, seorang dokter bedah yang kehilangan kariernya, menjadi Sorcerer Supreme.',
            'body' => 'Stephen Strange, seorang dokter bedah terkenal, kehilangan kariernya setelah kecelakaan mobil menghancurkan tangannya. Dalam pencarian penyembuhan, ia menemukan dunia sihir dan menjadi Sorcerer Supreme, melindungi dunia dari ancaman mistis seperti Dormammu dan Kaecilius.'
        ]);
        
        Post::create([
            'title' => 'Black Panther',
            'picture' => 'post-img/blackpanther.jfif',
            'category_id' => 4,
            'user_id' => 2,
            'visibility' => 'Public',
            'slug' => 'black-panther',
            'exerpt' => 'T\'Challa, raja Wakanda, melindungi negaranya sebagai Black Panther dengan kekuatan dan teknologi canggih.',
            'body' => 'T\'Challa, raja Wakanda, mengambil peran sebagai Black Panther untuk melindungi negaranya. Dengan kekuatan dari ramuan berbentuk hati dan teknologi vibranium, ia melawan ancaman seperti Killmonger dan menjaga rahasia Wakanda dari dunia luar.'
        ]);
        
        Post::create([
            'title' => 'Green Lantern',
            'picture' => 'post-img/greenlantern.jfif',
            'category_id' => 1,
            'user_id' => 1,
            'visibility' => 'Public',
            'slug' => 'green-lantern',
            'exerpt' => 'Hal Jordan dipilih oleh cincin kekuatan untuk menjadi anggota Green Lantern Corps.',
            'body' => 'Hal Jordan, seorang pilot pesawat tempur, dipilih oleh cincin kekuatan alien untuk menjadi anggota Green Lantern Corps. Dengan cincin tersebut, ia menciptakan konstruksi energi dan melindungi alam semesta dari ancaman kosmik seperti Sinestro dan Parallax.'
        ]);        
            
                
            
        Category::create([
            'name' => 'Pahlawan super klasik',
            'slug' => 'pahlawan-super-klasik',
        ]);
            
        Category::create([
            'name' => 'Pahlawan super tanpa kekuatan',
            'slug' => 'pahlawan-super-tanpa-kekuatan',
        ]);
            
        Category::create([
            'name' => 'Pahlawan super remaja',
            'slug' => 'pahlawan-super-remaja',
        ]);
            
        Category::create([
            'name' => 'Pahlawan super mitologi',
            'slug' => 'pahlawan-super-mitologi',
        ]);
            
        Category::create([
            'name' => 'Pahlawan super teknologi',
            'slug' => 'pahlawan-super-teknologi',
        ]);
    }
}
