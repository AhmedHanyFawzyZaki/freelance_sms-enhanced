<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\Collection;

class DirectoryControllerTest extends TestCase
{

    public function testNumberNotFound()
    {
        $response = $this->call(
            'POST',
            '/directory/search/',
            ['Body' => '000044 9999 ahmed hany 88']
        );
        $twilioResponse = new SimpleXMLElement($response->getContent());

        $this->assertEquals(
            'def msg',
            strval($twilioResponse->Message)
        );
    }

    public function testNumberFound()
    {
        $response = $this->call(
            'POST',
            '/directory/search/',
            ['Body' => 'this number 123456 please   call']
        );
        $twilioResponse = new SimpleXMLElement($response->getContent());

        $this->assertEquals('Hello',
            strval($twilioResponse->Message)
        );
    }

}
