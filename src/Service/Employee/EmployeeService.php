<?php

namespace App\Service\Employee;
use App\Entity\Employee;


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
     *  @param Employee $employee
     *  @return void
     */
    function addEmployee(Employee $employee): void;
    
    /** 
     *  Метод обновляет данные сотрудника
     * 
     *  @param Employee $employee
     *  @return void
     */
    function updateEmployee(Employee $employee): void;
    
    /** 
     *  Метод удаляет сотрудника
     *  @return void
     */
    function deleteEmployee(Employee $employee): void;

}