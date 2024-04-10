<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\CompanyAction;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CompanyLogoRequest;
use App\Http\Requests\CompanyRegistrationRequest;

class CompanyController extends Controller
{
    protected CompanyAction $companyAction;

    public function __construct()
    {
        $this->companyAction = new CompanyAction();
    }

     /**
     * Fetch all Company
     *
     * @return
     */
    public function list()
    {
        return $this->successResponse($this->companyAction->index(), "Companies fetch successfully");
    }

    /**
     * get company
     *
     * @return CompanyResource
     */
    public function show(string $companyId)
    {
        return $this->successResponse($this->companyAction->showCompany($companyId), "company fetch successfully");
    }

     /**
     * Create new account
     *
     * @param CompanyRegistrationRequest $request
     * @return JsonResponse
     */
    public function createCompany(CompanyRegistrationRequest $request) :JsonResponse
    {
        $response = $this->companyAction->createNewCompany($request);
        return $this->successResponse($response, "Company created successfully", 201);
    }

     /**
     * Update company
     *
     * @param CompanyRegistrationRequest $request
     * @return CompanyResource
     */
    public function updateCompany(CompanyRegistrationRequest $request, $companyId)
    {
        return $this->successResponse($this->companyAction->updateCompany($request, $companyId), "Company updated successfully");
    }

    public function deleteCompany($companyId)
    {
        return $this->successResponse($this->companyAction->deleteCompany($companyId), "Company deleted Successfully");
    }

    /**
     * upload logo
     *
     * @param CompanyLogoRequest $request
     * @return
     */
    public function companyLogo(CompanyLogoRequest $request, $companyId)
    {
        return $this->successResponse($this->companyAction->uploadLogo($request, $companyId), "Company logo uploaded successful");
    }
}
