<?php

namespace Schoutentech\Webshop\Console;

use Illuminate\Console\Command;

class AddBrandCommand extends Command {
  protected $name = "webshop:make";

  protected $signature = "webshop:make {brand}";

  protected $description = "creating a new webshop and brand";

  public function handle(){
    $brand = $this->argument("brand");
    $this->info("creating $brand");

  }
}
