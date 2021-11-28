<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        // извлечь тестового пользователя
        $testUser = $userRepository->findOneByEmail('t@t.t');

        // симулировать вход $testUser в систему
        $client->loginUser($testUser);

        // тестировать, например, страницу профиля
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div', 'Hello');
    }
}
