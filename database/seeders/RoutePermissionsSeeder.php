<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RoutePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Get all routes
        $routes = Route::getRoutes();
        
        foreach ($routes as $route) {
            // Only process named routes
            if ($route->getName()) {
                // Check if the permission already exists
                if (!Permission::where('name', $route->getName())->exists()) {
                    // Create a new permission using the route name
                    Permission::create(['name' => $route->getName()]);
                }
            }
        }
    }
}
