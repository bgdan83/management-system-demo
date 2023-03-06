<?php

namespace App\Service\Employee\Impl;

use App\Repository\Employee\EmployeeRepository;
use App\Service\Employee\EmployeeService;
use Symfony\Component\HttpFoundation\Request;
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
     *  @param Request $request
     *  @param $form
     *  @param Employee $employee
     *  @return bool
     */
    public function addEmployeeForm( 
        Request $request,
        $form,
        Employee $employee
    ): bool {
        
        $result = false;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->employeeRepository->add($employee);
   
            $result = true;
        }
        
        return $result;
    }
    
    /** 
     *  Метод обновляет данные сотрудника
     * 
     *  @param Request $request
     *  @param $form
     *  @param Employee $employee
     *  @return bool
     */
    public function updateEmployeeForm( 
        Request $request,
        $form,
        Employee $employee
    ): bool {
        
        $result = false;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->employeeRepository->update($employee);
   
            $result = true;
        }
        
        return $result;
    }
    
    /** 
     *  Метод удаляет сотрудника
     * 
     */
    public function deleteEmployeeForm(Employee $employee) 
    {
        $this->employeeRepository->delete($employee);
    }

}
