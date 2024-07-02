<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blog>
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function getAllBlogs(): array
    {
        return $this->createQueryBuilder('blog')
                ->orderBy('blog.CreatedAt', 'DESC')
                ->getQuery()
                ->getResult()
            ;
    }

    public function getNumberOfBlogs(): int
    {
        return $this->count();
    }

    public function save(Blog $blog)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($blog);
        $entityManager->flush();
    }

    public function delete(Blog $blog)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($blog);
        $entityManager->flush();
    }
}
