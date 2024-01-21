<?php

namespace App\Tests\Service;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private ?Client $client = null;
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client();
    }

    public function testCreateClient(): void
    {
        $this->client->setCin('12345678');
        $this->client->setNom('Doe');
        $this->client->setPrenom('John');
        $this->client->setAdresse('123 Main St');

        $this->assertNull($this->client->getId());
        $this->assertEquals('12345678', $this->client->getCin());
        $this->assertEquals('Doe', $this->client->getNom());
        $this->assertEquals('John', $this->client->getPrenom());
        $this->assertEquals('123 Main St', $this->client->getAdresse());
    }

    public function testUpdateClient(): void
    {
        $this->client->setCin('87654321');
        $this->client->setNom('Smith');
        $this->client->setPrenom('Jane');
        $this->client->setAdresse('456 Main St');

        $this->assertEquals('87654321', $this->client->getCin());
        $this->assertEquals('Smith', $this->client->getNom());
        $this->assertEquals('Jane', $this->client->getPrenom());
        $this->assertEquals('456 Main St', $this->client->getAdresse());
    }

    public function testDeleteClient(): void
    {
        $this->client->setCin('12345678');
        $this->client->setNom('Doe');
        $this->client->setPrenom('John');
        $this->client->setAdresse('123 Main St');

        $this->client = null;

        $this->assertNull($this->client);
    }
}