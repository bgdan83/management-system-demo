<?php

namespace App\Service\Employee\Impl;

use App\Repository\Employee\EmployeeRepository;
use App\Service\Employee\EmployeeService;


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


}
