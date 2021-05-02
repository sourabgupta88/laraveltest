<?php


namespace App\Services;

use App\AppLog;
use App\Repositories\Repository;

class LogService
{

  /**
   * @var Repository
   */
  protected $appLogModel;

  public function __construct(
    AppLog $appLog
  )
  {
    $this->appLogModel = new Repository($appLog);
  }

  public function createLogReturnId(string $title)
  {
    //Initialise the log, save in Log table and get the logId for later use
    $logEvent = $this->appLogModel->create([
      'title' =>$title,
    ]);

    return $logEvent->id;
  }

  public function updateLogReturn($updateArr = [], $id)
  {
    $this->appLogModel->update($updateArr, $id);
    return $id;
  }

}
