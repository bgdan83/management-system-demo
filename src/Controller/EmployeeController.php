<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Employee\Impl\EmployeeServiceImpl;
use App\Repository\Employee\EmployeeRepository;
use App\Entity\Employee;
use App\Form\Employee\EmployeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/employee')]
class EmployeeController extends AbstractController
{
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * WishlistController constructor.
     * @param EmployeeService $employeeService
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(
        EmployeeServiceImpl $employeeService, 
        EmployeeRepository $employeeRepository
    ) {
        $this->employeeService = $employeeService;
        $this->employeeRepository = $employeeRepository;
    }
    
    /**
     * @Route("/", name="employee")
     */
    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        
        return $this->render('employee/employee.html.twig', [
            'employees' => $employees,
            'year' => date('Y')
        ]);
    }
    
    /**
     * @Route("/new", name="employee_new")
     */
    public function addEmployeeForm( 
        Request $request, 
        EntityManagerInterface $entityManager,
    ): Response {
        
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employee);
            $entityManager->flush();
            $this->addFlash('success', 'Success! Employee added.');

            return $this->redirectToRoute('employee');
        }

        return $this->render('employee/employee_new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id<\d+>}/edit', name: 'employee_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Employee $employee,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Updated successfully.');

            return $this->redirectToRoute(
                'employee_edit',
                ['id' => $employee->getId()]
            );
        }

        return $this->render('employee/employee_new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}/delete', name: 'employee_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Employee $employee,
        EntityManagerInterface $entityManager
    ): Response {
        /** @var string|null $token */
        $token = $request->request->get('token');

        if (!$this->isCsrfTokenValid('delete', $token)) {
            return $this->redirectToRoute('employee');
        }

        $entityManager->remove($employee);
        $entityManager->flush();

        $this->addFlash('success', 'Deleted successfully.');

        return $this->redirectToRoute('employee');
    }

}

