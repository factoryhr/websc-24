<?php


namespace App\Tests\Unit;

use App\Repository\BlogRepository;
use App\Tests\Support\UnitTester;

class BlogTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testBlogRepository_getNumberOfBlogs_returnsInt()
    {
        /** @var BlogRepository $blogRepository */
        $blogRepository = $this->tester->grabService(BlogRepository::class);
        $numberOfBlogs = $blogRepository->getNumberOfBlogs();
        $this->assertIsInt($numberOfBlogs);
    }
}
