<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\FunctionalTestCase;

class ExampleTest extends FunctionalTestCase
{
    /**
     * A login test.
     */
    public function testLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        // check for 401 due to allow only for user with admin role
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * A registration test.
     */
    public function testRegister(): void
    {
        $client = static::createClient();
        $client->request('GET', '/register');
        // check for 401 due to allow only for user with admin role
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
