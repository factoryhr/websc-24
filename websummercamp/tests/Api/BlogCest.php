<?php


namespace App\Tests\Api;

use App\Tests\Support\ApiTester;

class BlogCest
{
    public function _before(ApiTester $I)
    {
    }

    public function testGettingBlogsTitles(ApiTester $I)
    {
        $I->sendGet('/api/blogs/titles');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();

        $I->seeResponseJsonMatchesJsonPath('$.totalRecords');
        $I->seeResponseJsonMatchesJsonPath('$.titles');
    }
}
