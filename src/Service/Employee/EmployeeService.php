<?php

namespace App\Service\Employee;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Request;

/** 
 * Интерфейс работы с сотрудниками
 */
interface EmployeeService {
    
    
    /** 
     *  Метод возвращает всех сотрудников
     *  
     *  @return
     */
    function getAllEmployees();
    
    /** 
     *  Метод добавляет сотрудника
     * 
     *  @param Request $request
     *  @param $form
     *  @param Employee $employee
     *  @return bool
     */
    function addEmployeeForm(Request $request, $form, Employee $employee);
    
    /** 
     *  Метод обновляет данные сотрудника
     * 
     *  @param Request $request
     *  @param $form
     *  @param Employee $employee
     *  @return bool
     */
    function updateEmployeeForm(Request $request, $form, Employee $employee);
    
    /** 
     *  Метод удаляет сотрудника
     * 
     */
    function deleteEmployeeForm(Employee $employee);

}