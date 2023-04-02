<?php

namespace App\Test\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EventRepository $repository;
    private string $path = '/event/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Event::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Event index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'event[title]' => 'Testing',
            'event[type]' => 'Testing',
            'event[description]' => 'Testing',
            'event[startdate]' => 'Testing',
            'event[enddate]' => 'Testing',
            'event[ticketcount]' => 'Testing',
            'event[affiche]' => 'Testing',
            'event[ticketprice]' => 'Testing',
            'event[host]' => 'Testing',
            'event[location]' => 'Testing',
            'event[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/event/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Event();
        $fixture->setTitle('My Title');
        $fixture->setType('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStartdate('My Title');
        $fixture->setEnddate('My Title');
        $fixture->setTicketcount('My Title');
        $fixture->setAffiche('My Title');
        $fixture->setTicketprice('My Title');
        $fixture->setHost('My Title');
        $fixture->setLocation('My Title');
        $fixture->setUser('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Event');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Event();
        $fixture->setTitle('My Title');
        $fixture->setType('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStartdate('My Title');
        $fixture->setEnddate('My Title');
        $fixture->setTicketcount('My Title');
        $fixture->setAffiche('My Title');
        $fixture->setTicketprice('My Title');
        $fixture->setHost('My Title');
        $fixture->setLocation('My Title');
        $fixture->setUser('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'event[title]' => 'Something New',
            'event[type]' => 'Something New',
            'event[description]' => 'Something New',
            'event[startdate]' => 'Something New',
            'event[enddate]' => 'Something New',
            'event[ticketcount]' => 'Something New',
            'event[affiche]' => 'Something New',
            'event[ticketprice]' => 'Something New',
            'event[host]' => 'Something New',
            'event[location]' => 'Something New',
            'event[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/event/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getStartdate());
        self::assertSame('Something New', $fixture[0]->getEnddate());
        self::assertSame('Something New', $fixture[0]->getTicketcount());
        self::assertSame('Something New', $fixture[0]->getAffiche());
        self::assertSame('Something New', $fixture[0]->getTicketprice());
        self::assertSame('Something New', $fixture[0]->getHost());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Event();
        $fixture->setTitle('My Title');
        $fixture->setType('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStartdate('My Title');
        $fixture->setEnddate('My Title');
        $fixture->setTicketcount('My Title');
        $fixture->setAffiche('My Title');
        $fixture->setTicketprice('My Title');
        $fixture->setHost('My Title');
        $fixture->setLocation('My Title');
        $fixture->setUser('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/event/');
    }
}
