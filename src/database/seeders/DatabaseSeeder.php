<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use App\Models\Author;
use App\Models\Post;
use App\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // User::factory(10)->create();
        // Product::factory(20)->create();
        // Category::factory(5)->create();

        // $categories = Category::all();
        // Product::all()->each(function($product) use ($categories) {

        //     $product->categories()->attach(
        //         $categories->random(rand(1,3))->pluck('id')->toArray()
        //     );

        // });

        Author::factory(5)->create()->each(function($Author) {
            Post::factory(3)->create(["author_id" => $Author->id]);
        });
        // Post::factory(5)->create();
        // Author::factory(5)->create();
    }
}