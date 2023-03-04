<?php

namespace App\Service\Employee\Impl;

use App\Repository\Employee\EmployeeRepository;
use App\Service\Employee\EmployeeService;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employee;

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

    public function getAllEmployees()
    {
        return $this->employeeRepository->findAll();
    }

    public function addEmployeeForm( 
        Request $request,
        $form,
        Employee $employee
    ): bool {
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->employeeRepository->add($employee);
   
            return true;
        }
        
        return false;
    }
    
    public function updateEmployeeForm( 
        Request $request,
        $form,
        Employee $employee
    ): bool {
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->employeeRepository->update($employee);
   
            return true;
        }
        
        return false;
    }
    
    public function deleteEmployeeForm(Employee $employee) 
    {
        $this->employeeRepository->delete($employee);
    }

}
