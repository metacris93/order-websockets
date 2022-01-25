<?php

namespace App\Console\Commands;

use App\Food;
use App\Jobs\ProcessOrderShipped;
use App\Mail\OrderShipped;
use App\Notifications\OrderShipmentNotification;
use App\Order;
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
        //$this->info(json_encode($food));
        if (is_null($food))
        {
            $this->error("No hay alimentos preparados");
            return;
        }
        //event(new OrderShipment($food));
        //$when = now()->addSeconds(10);
        //$food->notify((new OrderShipmentNotification())->delay($when));

        // $order = Order::first();
        // ProcessOrderShipped::dispatch(new OrderShipped($order))
        //     ->onQueue('order-shipped');

        $food->notify((new OrderShipmentNotification())->onQueue('broadcasts'));
    }
}
