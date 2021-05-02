<?php

namespace App\Http\Controllers;

use App\Helpers\NfStringHelper;
use App\User;
use Illuminate\Http\Request;
use App\Customer;
use App\Http\Resources\CustomerResource;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Gate;
use App\Services\CustomerService;
use App\AppLog;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CustomerRequest;
use App\Services\LogService;


/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * @var Repository
     */
    protected $customerModel;
    /**
     * @var CustomerService
     */
    protected $customerService;
    /**
     * @var Repository
     */
    protected $appLogModel;
   
    protected $logService;
   

    protected $apiOne = "API 1 CreateCustomer"; //GetCustomerRate

	/**
	 * CustomerController constructor.
	 * @param Customer $customerModel
	 * @param CustomerService $customerService
	 * @param AppLog $appLog
	 * @param LogService $logService
	 */
    public function __construct(
        Customer $customerModel,
        CustomerService $customerService,
        AppLog $appLog,
        LogService $logService
    )
    {

        $this->customerModel = new Repository($customerModel);
        $this->customerService = $customerService;
        $this->appLogModel = new Repository($appLog);
        $this->logService = $logService;
    }

    /**
     * @param Request $request
     * this is mainly we will use for partners customer
     * @return CustomerResource|string|null
     */
    public function createCustomer(CustomerRequest $request)
    {

		$logEventId = $this->logService->createLogReturnId($this->apiOne);
		$response = Gate::inspect('createCustomer');
		if(!$response->allowed())
		{
		   $logArr["response"] = $response->message();
		  // update the response to log table
		  $this->logService->updateLogReturn($logArr, $logEventId);
		   return response()->json([
			'status' => 200,
			'message' => $response->message()
		  ]);
		}
        
		$customerId = $this->customerService->createCustomer($request->all());
		$logArr = [];
        $logArr["request"] = $request->all();
        // update the response to log table
        $this->logService->updateLogReturn($logArr, $logEventId);
      
        return new CustomerResource($this->customerService->getCustomer($customerId));
    }

  
}
