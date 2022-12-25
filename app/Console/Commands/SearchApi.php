<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\DB;
class SearchApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $productInfo = DB::table('product_info')->get()->toArray();

        // dd($productInfo[0]);

        $client = ClientBuilder::create()->build();

        // $product = $productInfo[0];

        foreach( $productInfo as $product ){
            $params = [
                'index' => 'bifm',
                'id'    => 'bifm_id_' . $product->id,
                'body'  => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                ]
            ];
            
            $response = $client->index($params);
            var_dump($response);
        }

        // dd($response);

        return 0;
    }
}
