<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestDepotTest extends WebTestCase
{

    public function testDepot()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'Yama@gmail.com',
            'PHP_AUTH_PW'=>'pass123'
        ]);
        $crawler = $client->request('POST', '/api/inscris',[],[],
        ['CONTENT_TYPE'=>"application/json"],'
        {   
            ""compte_id":1,
            "montantdepot":75000
        }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
            $this->assertSame(401,$client->getResponse()->getStatusCode());
    }
}
