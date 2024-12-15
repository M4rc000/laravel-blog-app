<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Post
{
    // use HasFactory;

    private static $blog_post = [
        [
            'title' => 'Post pertama',
            'author' => 'Prime',
            'slug' => 'satu',
            'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error, quas. Non nemo dolorem explicabo totam reiciendis ipsa odio qui ullam quae voluptatibus dolore sed dolor voluptates ducimus saepe veniam quia ea quas quibusdam error inventore, neque rem quisquam. Atque, eos! Ullam laboriosam voluptas architecto cum eum pariatur at mollitia veritatis unde. Ad dolor soluta inventore. Cum, dolores nesciunt labore assumenda reprehenderit enim distinctio sapiente, ipsa laudantium pariatur maxime voluptatem vel. Soluta, odit sint iusto quos quod quas possimus porro. Possimus qui laboriosam illo quaerat harum culpa! Rem quos vero deleniti iusto aspernatur reprehenderit porro cumque? Odio quo ipsam necessitatibus corporis?'
        ],
        [
            'title' => 'Post Kedua',
            'author' => 'Scientist',
            'slug' => 'dua',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab dignissimos id reprehenderit iure in rem vero asperiores praesentium aspernatur minima, quos animi vel voluptas nostrum culpa est eveniet veniam cum modi facere qui! Delectus provident est, adipisci eius necessitatibus quia veniam, dolorum maiores a dicta in saepe quidem, culpa sint!'
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_post);
    }

    public static function find($slug){
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
