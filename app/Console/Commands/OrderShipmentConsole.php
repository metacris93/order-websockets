<?php

namespace App\Console\Commands;

use App\Events\OrderShipment;
use App\Food;
use App\Notifications\OrderShipmentNotification;
use Illuminate\Console\Command;

class OrderShipmentConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'os:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send order shipment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $food = Food::first();
        $this->info(json_encode($food));
        if (is_null($food))
        {
            $this->error("No hay alimentos preparados");
            return;
        }
        //event(new OrderShipment($food));
        $food->notify(new OrderShipmentNotification());
    }
}
