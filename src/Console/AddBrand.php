<?php

namespace Schoutentech\Webshop\Console;

use Illuminate\Console\Command;
use App\Models\User;
use Schoutentech\Webshop\Models\Brand;
use Schoutentech\Webshop\Models\Product;
use Illuminate\Support\Facades\Hash;

class AddBrand extends Command {
  protected $name = "webshop:make";

  protected $signature = "webshop:make {brand}";

  protected $description = "creating a new webshop and brand";

  public function handle(){
    $brand_name = $this->argument("brand");
    $this->info("Getting ready for the creation of $brand_name.");
    \Artisan::call("migrate");
    $this->info("Creating brand..");
    $brand = new Brand();
    $brand->brand_name = $brand_name;
    // more coming soon!
    $brand->save();
    $this->info("Brand created.");
    $this->info("Creating first user.");
    $user_name = $this->ask("Username[admin] ");
    if (is_null($user_name)) {
      $user_name = "admin";
    }
    $user_password = null;
    while (is_null($user_password)) {
      $user_password = $this->secret("Password ");
    }
    $user = new User();
    $user->name = $user_name;
    $user->password = Hash::make($user_password);
    $user->brand_id = $brand->id;
    $user->email = "admin@" . $brand_name . ".com";
    $user->save();
    $this->info("Adding routes.");
    $routes = """
    Route::group()
    """
    file_put_contents( app_path('/../routes/web.php'), "Route::get('/', function(){return view('dashboard')})->domain('$brand_name' . env('APP_URL'))", FILE_APPEND );
    $this->info("100%");
  }
}
