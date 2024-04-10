<?php
namespace App\Actions;

use Exception;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CompanyResource;
use App\Http\Requests\CompanyLogoRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\CompanyRegistrationRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CompanyAction
{
    /**
     * get companies
     *
     * @return
     */
    public function index():LengthAwarePaginator
    {
        return CompanyResource::collection(Company::orderBy("created_at","DESC")->paginate(10))->resource;

    }

    /**
     * get user company
     *
     * @return CompanyResource
     */
    public function showCompany(string $companyId):CompanyResource
    {
        $company = Company::whereId($companyId)->first();

        abort_if(!$company, 400,  "Company not found.");

        return new CompanyResource($company);
    }

    /**
     * Create new company
     *
     * @param CompanyRegistrationRequest $request
     * @return
     */
    public function createNewCompany(CompanyRegistrationRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $company = Company::create($data);

            return new CompanyResource($company);
        } catch (Exception $e) {
            abort(400, "Error creating company, please try again later", [$e->getMessage()]);
        }
    }

    /**
     * Update company
     *
     * @param CompanyRegistrationRequest $request
     * @return CompanyResource
     */
    public function updateCompany(CompanyRegistrationRequest $request, $companyId): CompanyResource
    {
        $company = $this->getCompany($companyId);
        $company->update([
            'company_name' => $request->company_name,
            'business_type' => $request->business_type,
            'business_decription' => $request->business_decription,
            'address' => $request->address,
            'contact_information' => $request->contact_information,
        ]);
        $company->refresh();
        return new CompanyResource($company);
    }

     /**
     * Delete company
     *
     * @return Company
     */
    public function deleteCompany($companyId)
    {
        $company = $this->getCompany($companyId);
        $company->delete();
    }

     /**
     * upload company logo
     *
     * @param CompanyLogoRequest $request
     * @return CompanyResource
     */
    public function uploadLogo(CompanyLogoRequest $request, $companyId): CompanyResource
    {
        $company = $this->getCompany($companyId);
        if($company->company_logo)
        {
           $this->removeImageUpload($company->company_logo);
        }
        $logo = $this->uploadImage($request->company_logo, "logo");

        $company->update([
            'company_logo' => $logo,
        ]);

        $company->refresh();
        return new CompanyResource($company);
    }

     /**
     * Get company
     *
     * @return Company
     */
    private function getCompany($id)
    {
        return Company::findOrFail($id);
    }

    private function uploadImage(UploadedFile $file, string $location)
    {
        $path = $location."/".$this->getTrx(6).time().".".$file->extension();

       Storage::disk('images')->put($path, $file->getContent());

       return $path;
    }

    private function removeImageUpload(string $location)
    {
        if(file_exists(public_path()."/images/".$location))
        {
            unlink(public_path()."/images/".$location);
        }
    }

    private function getTrx($length = 12)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
