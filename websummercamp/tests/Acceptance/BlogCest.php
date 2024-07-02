<?php


namespace App\Tests\Acceptance;

use App\Tests\Support\AcceptanceTester;
use Codeception\Attribute\Depends;

class BlogCest
{
    private const BLOG_TITLE = 'Automated Test Title';
    private const BLOG_CONTENT = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";

    public function _before(AcceptanceTester $I)
    {
    }

    public function testCreateBlog(AcceptanceTester $I)
    {
        $I->actAsUser('test@gmail.com', 'qweasdyxc');

        $I->see('Create a new blog');
        $I->click('Create a new blog');
        $I->wait(1);

        $I->see('Create a new blog', 'h1');

        $I->fillField('blog[Title]', self::BLOG_TITLE);
        $I->fillField('blog[Content]', self::BLOG_CONTENT);

        $I->click('button[type="submit"]');
        $I->wait(2);

        $I->see(self::BLOG_TITLE);
        $I->see(sprintf('Delete "%s"', self::BLOG_TITLE));
    }

    #[Depends('testCreateBlog')]
    public function testShowBlog(AcceptanceTester $I)
    {
        $I->actAsUser('test@gmail.com', 'qweasdyxc');

        $I->amOnPage('/blogs');
        $I->wait(1);

        $I->see(self::BLOG_TITLE);
        $I->click(self::BLOG_TITLE);
        $I->wait(1);

        $I->see(self::BLOG_TITLE, 'h1');
        $I->see(self::BLOG_CONTENT);
        $I->see('Published: ');
    }

    #[Depends('testShowBlog')]
    public function testDeleteBlog(AcceptanceTester $I)
    {
        $I->actAsUser('test@gmail.com', 'qweasdyxc');

        $I->amOnPage('/blogs');
        $I->wait(1);

        $I->see(sprintf('Delete "%s"', self::BLOG_TITLE));
        $I->click(sprintf('Delete "%s"', self::BLOG_TITLE));
        $I->wait(1);

        $I->dontSee(self::BLOG_TITLE);
    }
}
