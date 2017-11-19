<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'recipes' )->insert([
            'user_id' => '1',
            'name' => 'Grilled Cheese Sandwich',
            'description' => 'This is a recipe for a basic grilled cheese sandwich.',
            'source' => 'Patrick',
            'prep_time' => '5',
            'cook_time' => '5',
            'servings' => '1',
            'serving_size' => 'sandwich',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ]);

        DB::table( 'ingredients' )->insert([
            'recipe_id' => '1',
            'order_number' => '1',
            'ingredient' => '2 slices of bread',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '2',
            'ingredient' => '2 slices of pre-packaged cheese singles',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '3',
            'ingredient' => '3 tablespoons of buttery spread',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ]);

        DB::table( 'directions' )->insert([
            'recipe_id' => '1',
            'order_number' => '1',
            'direction' => 'Pre-heat griddle or pan to medium heat.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '2',
            'ingredient' => 'Spread butter on one side of each slice of bread.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '3',
            'ingredient' => 'When cooking surface is hot, place one slice of bread butter-side down on surface.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '4',
            'ingredient' => 'Place two cheese slices on the toasting bread and place 2nd slice of bread, butter side up, on top.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '5',
            'ingredient' => 'When bottom bread is browned nicely (golden color), flip sandwich over so top-butter is now down on the cooking surface.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '6',
            'ingredient' => 'Let sandwich cook until the 2nd side is browned.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ])->insert([
            'recipe_id' => '1',
            'order_number' => '7',
            'ingredient' => 'Remove sandwich from heat and serve immediately.',
            'created_at' => '2015-09-16 21:27:37',
            'updated_at' => '2015-09-16 21:27:37',
        ]);
    }
}
