<?php

namespace App\Console\Commands;

use App\Events\OrderUpdated;
use App\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OrderUpdatedConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ou:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to indicate that the order was updated';

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
        $orders = DB::table('orders')->whereNotNull('buyer_id')->get();
        if ($orders->isEmpty())
        {
            $this->error("No hay ordenes asignadas a ningun adminsitrador");
            return;
        }
        $order = $orders->first();
        event(new OrderUpdated($order));
    }
}
