<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestFCTTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'admin@gmail.com',
            'PHP_AUTH_PW'=>'pass123'
        ]);
        $crawler = $client->request('POST', '/api/inscris',[],[],
            ['CONTENT_TYPE'=>"application/json"],'
            {
                "username":"Yahya@gmail.com",
                "password":"pass123",
                "nom":"LY",
                "prenom":"Yaya",
                "teluser":"771236655"
            }'
    );
    $rep=$client->getResponse();
    var_dump($rep);
        $this->assertSame(401,$client->getResponse()->getStatusCode());
    }
}
