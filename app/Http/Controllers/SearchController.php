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

        $mappingSite = [
            1 => 'chotot',
            2 => 'shopee',
            3 => 'lazada',
            4 => 'tiki'
        ];

        $params = [
            'index' => 'bifm',
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'match' => [
                                'doc.name' => $request->request->get('q') ?? ''
                            ]
                        ],
                        'must_not' => [
                            'match' => [
                                'doc.site_id' => 3
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        $response = $client->search($params);

        $arrReturn = [];

        if( isset($response['hits']['hits']) && count($response['hits']['hits']) > 0 ){
            foreach( $response['hits']['hits'] as $product ){
                // $product['_source']['doc']['thumb'] = json_decode($product['_source']['doc']['thumb']);
                $product['_source']['doc']['site_name'] = $mappingSite[$product['_source']['doc']['site_id']];
                $arrReturn[] = $product['_source']['doc'];
            }
        }

        return response()->json($arrReturn);
    }
}
