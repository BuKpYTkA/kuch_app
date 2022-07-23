<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Test User',
            'password' => Hash::make('111222'),
            'email' => 'test@example.com'
        ]);
        $category = Category::query()->create([
            'title' => 'Computers'
        ]);
        /** @var Product $product */
        $product = Product::query()->create([
            'title' => 'Intel PC',
            'description' => 'Nice pc for students',
            'price' => 2000000,
            'category_id' => $category->getKey()
        ]);
        $product->addMainImageFromContent(file_get_contents(public_path('img/computer_1.jpg')));

        /** @var Product $product */
        $product = Product::query()->create([
            'title' => 'Asus PC. Very nice',
            'description' => 'Nice and powerful pc for anyone who wants to have a PC',
            'price' => 5345900,
            'category_id' => $category->getKey()
        ]);
        $product->addMainImageFromContent(file_get_contents(public_path('img/computer_2.jpg')));

        $category = Category::query()->create([
            'title' => 'Phones'
        ]);
        $product = Product::query()->create([
            'title' => 'Iphone XX',
            'description' => 'Newest Apple device for stupid girls',
            'price' => 2340000,
            'category_id' => $category->getKey()
        ]);
        $product->addMainImageFromContent(file_get_contents(public_path('img/phone_2.jpg')));

        /** @var Product $product */
        $product = Product::query()->create([
            'title' => 'Nokia 3310',
            'description' => 'Classic masterpiece for your grandmother',
            'price' => 25000,
            'category_id' => $category->getKey()
        ]);
        $product->addMainImageFromContent(file_get_contents(public_path('img/phone_1.jpg')));

        $category = Category::query()->create([
            'title' => 'Musical Instruments'
        ]);
        $product = Product::query()->create([
            'title' => 'Ibanez XY34',
            'description' => 'Nice electric guitar for your metalhead son',
            'price' => 5565000,
            'category_id' => $category->getKey()
        ]);
        $product->addMainImageFromContent(file_get_contents(public_path('img/musical_1.jpg')));

        /** @var Product $product */
        $product = Product::query()->create([
            'title' => 'Drums KEK',
            'description' => "Do you want tou punish your neighbors? That's your choice",
            'price' => 12560000,
            'category_id' => $category->getKey()
        ]);
        $product->addMainImageFromContent(file_get_contents(public_path('img/musical_2.jpeg')));
    }
}
