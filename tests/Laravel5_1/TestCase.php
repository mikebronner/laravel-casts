<?php namespace GeneaLabs\LaravelCasts\Tests\Laravel5_1;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Symfony\Component\DomCrawler\Crawler;

abstract class TestCase extends BaseTestCase
{
    protected $crawler;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $this->crawler = new Crawler();
        $app = require __DIR__ . '/../../../../../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function seeElement($selector, array $attributes = [], $negate = false)
    {
        return $this->assertInPage(new HasElement($selector, $attributes), $negate);
    }

    public function dontSeeElement($selector, array $attributes = [])
    {
        return $this->assertInPage(new HasElement($selector, $attributes), true);
    }

    protected function assertInPage(PageConstraint $constraint, $reverse = false, $message = '')
    {
        if ($reverse) {
            $constraint = new ReversePageConstraint($constraint);
        }

        self::assertThat(
            $this->crawler() ?: $this->response->getContent(),
            $constraint, $message
        );

        return $this;
    }

    protected function crawler()
    {
        if (! empty($this->subCrawlers)) {
            return end($this->subCrawlers);
        }

        return $this->crawler;
    }
}
