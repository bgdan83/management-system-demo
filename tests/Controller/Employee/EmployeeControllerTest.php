<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller\Employee;


use App\Repository\PostRepository;
use App\Repository\Employee\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test for the controllers defined inside the BlogController used
 * for managing the blog in the backend.
 *
 * See https://symfony.com/doc/current/testing.html#functional-tests
 *
 * Whenever you test resources protected by a firewall, consider using the
 * technique explained in:
 * https://symfony.com/doc/current/testing/http_authentication.html
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class EmployeeControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }
    
    /**  
     *  Method test new employee
     * 
     *  @return void
     */
    public function testNewEmployee(): void
    {
        $firstName = $this->generateRandomString(10);
        $lastName = $this->generateRandomString(10);
        $email = 'dummy@test.com';
        
        $this->client->request('GET', '/employee/new');
        
        $this->client->submitForm('new-employee', [
            'employee[firstName]' => $firstName,
            'employee[lastName]' => $lastName,
            'employee[email]' => $email,
        ]);

        $this->assertResponseRedirects('/employee/', Response::HTTP_FOUND);

        /** @var EmployeeRepository $employeeRepository */
        $employeeRepository = static::getContainer()->get(EmployeeRepository::class);

        /** @var \App\Entity\Employee $employee */
        $employee = $employeeRepository->findOneByFirstName($firstName);

        $this->assertNotNull($employee);
        $this->assertSame($firstName, $employee->getFirstName());
        $this->assertSame($lastName, $employee->getLastName());
    }

    /**  
     * Method generate random string
     * 
     * @param int length
     * @return string
     */
    private function generateRandomString(int $length): string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return mb_substr(str_shuffle(str_repeat($chars, (int) ceil($length / mb_strlen($chars)))), 1, $length);
    }
}