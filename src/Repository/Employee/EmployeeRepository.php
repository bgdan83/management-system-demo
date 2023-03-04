<?php

namespace App\Repository\Employee;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class EmployeeRepository extends ServiceEntityRepository
{
    
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
        
        $this->entityManager = $this->getEntityManager();
    }
    
    public function add(Employee $employee) 
    {
        $this->entityManager->persist($employee);
        $this->entityManager->flush();
    }
    
    public function update(Employee $employee) 
    {
        $this->entityManager->flush();
    }

    public function delete(Employee $employee) 
    {
        $this->entityManager->remove($employee);
        $this->entityManager->flush();
    }
}
