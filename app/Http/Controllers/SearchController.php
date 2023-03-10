<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'bifm',
            'body'  => [
                'query' => [
                    'match' => [
                        'doc.name' => $request->request->get('q') ?? ''
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
        dd($arrReturn);
        return response()->json($arrReturn);
    }
}
