<?php

namespace App\Actions;

use Exception;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\EmployeeRegistrationRequest;

class EmployeeAction
{
     /**
     * get companies
     *
     * @return
     */
    public function index():LengthAwarePaginator
    {
        return EmployeeResource::collection(Employee::orderBy("created_at","DESC")->paginate(10))->resource;

    }

    /**
     * Create new Employee
     *
     * @param EmployeeRegistrationRequest $request
     * @return
     */
    public function addEmployee(EmployeeRegistrationRequest $request)
    {
        try {
            $data = $request->all();
            $employee = Employee::create($data);

            return new EmployeeResource($employee);

        } catch (Exception $e) {
            abort(400, "Error creating employee, please try again later", [$e->getMessage()]);
        }
    }

     /**
     * get employee
     *
     * @return EmployeeResource
     */
    public function showEmployee(string $employeeId):EmployeeResource
    {
        $employee = Employee::whereId($employeeId)->first();

        abort_if(!$employee, 400,  "Employee not found.");

        return new EmployeeResource($employee);
    }

     /**
     * Update Employee
     *
     * @param EmployeeRegistrationRequest $request
     * @return EmployeeResource
     */
    public function update(EmployeeRegistrationRequest $request, $employeeId): EmployeeResource
    {
        $employee = $this->getEmployee($employeeId);
        $employee->update([
            'name' => $request->name,
            'employee_number' => $request->employee_number,
            'gender' => $request->gender,
            'company_id' => $request->company_id,
            'phone' => $request->phone,
        ]);
        $employee->refresh();
        return new EmployeeResource($employee);
    }

     /**
     * Delete Employee
     *
     * @return Employee
     */
    public function deleteEmployee($employeeId)
    {
        $employee = $this->getEmployee($employeeId);
        $employee->delete();
    }

    /**
     * Get Employee
     *
     * @return Employee
     */
    private function getEmployee($id)
    {
        return Employee::findOrFail($id);
    }

}
