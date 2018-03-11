<?php
namespace ApiTest\Controller;

use Api\Controller\ApiController;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ApiControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $configOverrides = [
            'module_listener_options' => [
                // Turn off caching
                'config_cache_enabled'     => false,
                'module_map_cache_enabled' => false,
            ],
        ];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testBooksActionCanBeAccessed()
    {
        $this->dispatch('/books', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('api');
        $this->assertControllerName(ApiController::class);
        $this->assertControllerClass('ApiController');
        $this->assertMatchedRouteName('books');
    }

    public function testBooksAuthorsCanBeAccessed()
    {
        $this->dispatch('/authors', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('api');
        $this->assertControllerName(ApiController::class);
        $this->assertControllerClass('ApiController');
        $this->assertMatchedRouteName('authors');
    }
}
