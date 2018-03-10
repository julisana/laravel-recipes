<?php

use Carbon\Carbon;
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
        $now = Carbon::now();
        DB::table( 'recipes' )->insert( [
            'user_id' => '2',
            'name' => 'Grilled Cheese Sandwich',
            'description' => 'This is a recipe for a basic grilled cheese sandwich.',
            'source' => 'Patrick',
            'prep_time' => '5',
            'cook_time' => '5',
            'servings' => '1',
            'serving_size' => 'sandwich',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );

        DB::table( 'ingredients' )->insert( [
            'recipe_id' => '1',
            'order_number' => '1',
            'name' => '2 slices of bread',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'ingredients' )->insert( [
            'recipe_id' => '1',
            'order_number' => '2',
            'name' => '2 slices of pre-packaged cheese singles',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'ingredients' )->insert( [
            'recipe_id' => '1',
            'order_number' => '3',
            'name' => '3 tablespoons of buttery spread',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );

        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '1',
            'name' => 'Pre-heat griddle or pan to medium heat.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '2',
            'name' => 'Spread butter on one side of each slice of bread.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '3',
            'name' => 'When cooking surface is hot, place one slice of bread butter-side down on surface.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '4',
            'name' => 'Place two cheese slices on the toasting bread and place 2nd slice of bread, butter side up, on top.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '5',
            'name' => 'When bottom bread is browned nicely (golden color), flip sandwich over so top-butter is now down on the cooking surface.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '6',
            'name' => 'Let sandwich cook until the 2nd side is browned.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
        DB::table( 'directions' )->insert( [
            'recipe_id' => '1',
            'order_number' => '7',
            'name' => 'Remove sandwich from heat and serve immediately.',
            'created_at' => $now->format( 'Y-m-d H:i:s' ),
            'updated_at' => $now->format( 'Y-m-d H:i:s' ),
        ] );
    }
}
