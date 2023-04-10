<?php

namespace App\Test\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/produit/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Produit::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'produit[codeproduit]' => 'Testing',
            'produit[des]' => 'Testing',
            'produit[qtestock]' => 'Testing',
            'produit[qtemin]' => 'Testing',
            'produit[prixunitaire]' => 'Testing',
            'produit[idunite]' => 'Testing',
            'produit[image]' => 'Testing',
            'produit[idcat]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setCodeproduit('My Title');
        $fixture->setDes('My Title');
        $fixture->setQtestock('My Title');
        $fixture->setQtemin('My Title');
        $fixture->setPrixunitaire('My Title');
        $fixture->setIdunite('My Title');
        $fixture->setImage('My Title');
        $fixture->setIdcat('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setCodeproduit('Value');
        $fixture->setDes('Value');
        $fixture->setQtestock('Value');
        $fixture->setQtemin('Value');
        $fixture->setPrixunitaire('Value');
        $fixture->setIdunite('Value');
        $fixture->setImage('Value');
        $fixture->setIdcat('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'produit[codeproduit]' => 'Something New',
            'produit[des]' => 'Something New',
            'produit[qtestock]' => 'Something New',
            'produit[qtemin]' => 'Something New',
            'produit[prixunitaire]' => 'Something New',
            'produit[idunite]' => 'Something New',
            'produit[image]' => 'Something New',
            'produit[idcat]' => 'Something New',
        ]);

        self::assertResponseRedirects('/produit/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCodeproduit());
        self::assertSame('Something New', $fixture[0]->getDes());
        self::assertSame('Something New', $fixture[0]->getQtestock());
        self::assertSame('Something New', $fixture[0]->getQtemin());
        self::assertSame('Something New', $fixture[0]->getPrixunitaire());
        self::assertSame('Something New', $fixture[0]->getIdunite());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getIdcat());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setCodeproduit('Value');
        $fixture->setDes('Value');
        $fixture->setQtestock('Value');
        $fixture->setQtemin('Value');
        $fixture->setPrixunitaire('Value');
        $fixture->setIdunite('Value');
        $fixture->setImage('Value');
        $fixture->setIdcat('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/produit/');
        self::assertSame(0, $this->repository->count([]));
    }
}
