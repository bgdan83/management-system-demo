<?php

namespace App\Service\Employee\Impl;

use App\Repository\Employee\EmployeeRepository;
use App\Service\Employee\EmployeeService;
use App\Entity\Employee;

/** 
 *  Class EmployeeServiceImpl  
 */
class EmployeeServiceImpl implements EmployeeService
{

    /**
     * @var EmployeeRepository $employeeRepository
     */
    private EmployeeRepository $employeeRepository;

    /**
     * EmployeeServiceImpl constructor.
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    
    /** 
     *  Метод возвращает всех сотрудников
     *  
     *  @return
     */
    public function getAllEmployees()
    {
        return $this->employeeRepository->findAll();
    }
    
    /** 
     *  Метод добавляет сотрудника
     * 
     *  @param Employee $employee
     *  @return void
     */
    public function addEmployee($employee): void
    {
        $this->employeeRepository->add($employee);
    }
    
    /** 
     *  Метод обновляет данные сотрудника
     * 
     *  @param Employee $employee
     *  @return void
     */
    public function updateEmployee(Employee $employee): void
    {
        $this->employeeRepository->update($employee);
    }
    
    /** 
     *  Метод удаляет сотрудника
     * 
     *  @param Employee $employee
     *  @return void
     */
    public function deleteEmployee(Employee $employee): void
    {
        $this->employeeRepository->delete($employee);
    }

}
