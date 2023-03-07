<?php

namespace App\Repository\Employee;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class EmployeeRepository extends ServiceEntityRepository
{
    
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected EntityManagerInterface $entityManager;
    
    /**
     * WishlistController constructor.
     * 
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
        
        $this->entityManager = $this->getEntityManager();
    }
    
    /**
     * Метод добавляет в базу запись сотрудника
     * 
     * @param Employee $employee
     */
    public function add(Employee $employee) 
    {
        $this->entityManager->persist($employee);
        $this->entityManager->flush();
    }
    
    /**
     * Метод обновляет данные сотрудника в базе 
     * 
     */
    public function update() 
    {
        $this->entityManager->flush();
    }

    /**
     * Метод удаляет из базы запись сотрудника
     * 
     * @param Employee $employee
     */
    public function delete(Employee $employee) 
    {
        $this->entityManager->remove($employee);
        $this->entityManager->flush();
    }
}
