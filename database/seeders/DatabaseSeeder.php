<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        // 1. Admins
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '01700000001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Categories
        DB::table('categories')->insert([
            ['name' => 'Electronics', 'image' => 'electronics.jpg', 'description' => 'All kinds of electronics', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion', 'image' => 'fashion.jpg',  'description' => 'Clothing and accessories', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Home & Kitchen', 'image' => 'home.jpg',  'description' => 'Home appliances and kitchenware', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('sub_categories')->insert([
            [
                'id' => 1,
                'cat_id' => 1,
                'name' => 'Mobile Phones',
                'description' => 'Smartphones and accessories', // <-- add this
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'cat_id' => 1,
                'name' => 'Laptops',
                'description' => 'Laptops for all brands',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'cat_id' => 2,
                'name' => 'Men Clothing',
                'description' => 'Shirts, pants, and more',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 3. Brands
        DB::table('brands')->insert([
            ['name' => 'Brand A', 'description' => 'Top brand A', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brand B', 'description' => 'Top brand B', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 4. Units
        DB::table('units')->insert([
            ['name' => 'Piece', 'description' => 'Single item', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Box', 'description' => 'Box pack', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 5. Sizes
        DB::table('sizes')->insert([
            ['size' => 'Small', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['size' => 'Medium', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['size' => 'Large', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 6. Colors
        DB::table('colors')->insert([
            ['color' => 'Red', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['color' => 'Blue', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['color' => 'Green', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 7. Products
        DB::table('products')->insert([
            [
                'cat_id' => 1,
                'subcat_id' => 1,
                'brand_id' => 1,
                'unit_id' => 1,
                'size_id' => 1,
                'color_id' => 1,
                'code' => 'PROD001',
                'name' => 'Sample Product 1',
                'description' => 'This is a sample product 1',
                'image' => 'product1.jpg',
                'price' => 1000.00,
                'discount' => 50.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 2,
                'subcat_id' => 1,
                'brand_id' => 2,
                'unit_id' => 2,
                'size_id' => 2,
                'color_id' => 2,
                'code' => 'PROD002',
                'name' => 'Sample Product 2',
                'description' => 'This is a sample product 2',
                'image' => 'product2.jpg',
                'price' => 1500.00,
                'discount' => 100.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 8. Banners
        DB::table('banners')->insert([
            [
                'title' => 'Winter Sale',
                'slug' => Str::slug('Winter Sale'),
                'description' => 'Up to 50% off',
                'photo' => 'banner1.jpg',
                'status' => 1,
                'condition' => 'banner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New Arrivals',
                'slug' => Str::slug('New Arrivals'),
                'description' => 'Check out our new products',
                'photo' => 'banner2.jpg',
                'status' => 1,
                'condition' => 'banner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('All tables seeded successfully!');
    }
}
