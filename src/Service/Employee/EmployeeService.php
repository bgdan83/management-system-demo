<?php

namespace App\Service\Employee;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Request;


interface EmployeeService {
    
    function getAllEmployees();
    
    function addEmployeeForm(Request $request, $form, Employee $employee);
    
    function updateEmployeeForm(Request $request, $form, Employee $employee);
    
    function deleteEmployeeForm(Employee $employee);

}