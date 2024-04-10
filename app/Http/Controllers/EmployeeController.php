<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\EmployeeAction;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EmployeeRegistrationRequest;

class EmployeeController extends Controller
{
    protected EmployeeAction $employeeAction;

    public function __construct()
    {
        $this->employeeAction = new EmployeeAction();
    }

     /**
     * get employees
     *
     * @return
     */
    public function listEmployee()
    {
        return $this->successResponse($this->employeeAction->index(), "Employee fetch successfully");
    }

     /**
     * Create new employee
     *
     * @param EmployeeRegistrationRequest $request
     * @return JsonResponse
     */
    public function createEmployee(EmployeeRegistrationRequest $request) :JsonResponse
    {
        $response = $this->employeeAction->addEmployee($request);
        return $this->successResponse($response, "Employee created successfully", 201);
    }

     /**
     * get employee
     *
     * @return EmployeeResource
     */
    public function showEmployee(string $employeeId)
    {
        return $this->successResponse($this->employeeAction->showEmployee($employeeId), "Employee fetch successfully");
    }

     /**
     * Update Empoyee
     *
     * @param EmployeeRegistrationRequest $request
     * @return EmployeeResource
     */
    public function updateEmployee(EmployeeRegistrationRequest $request, $employeeId)
    {
        return $this->successResponse($this->employeeAction->update($request, $employeeId), "Employee updated successfully");
    }

     /**
     * Delete employee
     *
     * @return employee
     */
    public function deleteEmployee($employeeId)
    {
        return $this->successResponse($this->employeeAction->deleteEmployee($employeeId), "Employee deleted Successfully");
    }
}
