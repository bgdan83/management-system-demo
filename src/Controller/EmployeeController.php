<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Employee\Impl\EmployeeServiceImpl;
use App\Service\EmployeeService;
use App\Entity\Employee;
use App\Form\Employee\EmployeeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/employee')]
class EmployeeController extends AbstractController
{
    /**
     * @var EmployeeService $employeeService
     */
    private EmployeeServiceImpl $employeeService;

    /**
     * WishlistController constructor.
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeServiceImpl $employeeService) {
        $this->employeeService = $employeeService;
    }
    
    #[Route('/', name: 'employee')]
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        
        return $this->render('employee/employee.html.twig', [
            'employees' => $employees,
            'year' => date('Y')
        ]);
    }
    
    #[Route('/new', name: 'employee_new_get', methods: ['GET'])]
    public function addEmployeeForm(Request $request): Response 
    {
        $form = $this->createForm(EmployeeType::class);
        
        return $this->render('employee/employee_new.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route('/new', name: 'employee_new_post', methods: ['POST'])]
    public function addEmployeeFormHandle(Request $request): Response 
    {
        $form = $this->createForm(EmployeeType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {  
            $this->employeeService->addEmployee($form->getData());    
            $this->addFlash('success', 'Success! Employee added.');
        }
        
        return $this->redirectToRoute('employee');
    }
    
    #[Route('/{id<\d+>}/edit', name: 'employee_edit_get', methods: ['GET'])]
    public function editEmployeeForm(Request $request, Employee $employee): Response 
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        return $this->render('employee/employee_new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id<\d+>}/edit', name: 'employee_edit_post', methods: [ 'POST'])]
    public function editEmployeeFormHandle(Request $request, Employee $employee): Response 
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {   
            $this->employeeService->updateEmployee($employee);          
            $this->addFlash('success', 'Updated successfully.');  
        }
        
        return $this->redirectToRoute(
                'employee_edit_get',
                ['id' => $employee->getId()]
        );
    }
    
    #[Route('/{id}/delete', name: 'employee_delete', methods: ['POST'])]
    public function delete(Request $request, Employee $employee): Response 
    {
        /** @var string|null $token */
        $token = $request->request->get('token');

        if (!$this->isCsrfTokenValid('delete', $token)) {
            return $this->redirectToRoute('employee');
        }

        $this->employeeService->deleteEmployee($employee);

        $this->addFlash('success', 'Deleted successfully.');

        return $this->redirectToRoute('employee');
    }

}

