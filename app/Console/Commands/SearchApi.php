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
        // $productInfo = DB::table('product_info')->get()->toArray();

        // $client = ClientBuilder::create()->build();

        // foreach( $productInfo as $product ){
        //     $params = [
        //         'index' => 'bifm',
        //         'id'    => 'bifm_id_' . $product->id,
        //         'body'  => [
        //             'name' => $product->name,
        //             'price' => $product->price,
        //             'description' => $product->description,
        //         ]
        //     ];
            
        //     $response = $client->index($params);
        //     var_dump($response);
        // }

        // dd($response);
        $this->search();
        return 0;
    }

    public function search(){
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'bifm',
            'body'  => [
                'query' => [
                    'match' => [
                        'name' => 'HP'
                    ]
                ]
            ]
        ];
        
        $response = $client->search($params);

        $arrReturn = [];

        if( isset($response['hits']['hits']) && count($response['hits']['hits']) > 0 ){
            foreach( $response['hits']['hits'] as $product ){
                $arrReturn[] = $product['_source'];
            }
        }

        $result = response()->json($arrReturn);

        dd($result);
    }
}
