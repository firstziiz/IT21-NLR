<?php

namespace App\Http\Controllers;


use App\Repositories\DashboardRepositoryInterface;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\SectionRepositoryInterface;

use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;


class DashboardController extends MainController
{
  protected $DashboardRepository;
  protected $SectionRepository;
  protected $UserRepository;
  protected $EnrollRepository;
  protected $BookingRepository;

  public function __construct(DashboardRepositoryInterface $DashboardRepository)
  {
    parent::__construct();
    $this->DashboardRepository = $DashboardRepository;

  }

  public function index()
  {

    $sectionCount = $this->DashboardRepository->getSectionCount();
    $enrollCount = $this->DashboardRepository->getEnrollCount();
    $userCount = $this->DashboardRepository->getUserCount();

    // $section = $this->DashboardRepository->getHotSection();

    $user = Auth::user();
    $userId = $user['id'];
    $enrollByUser = $this->DashboardRepository->getEnrollByUser($userId);
    $content = array(
      'sectionCount' => $sectionCount,
      'enrollCount' => $enrollCount,
      'userCount' => $userCount,
      'enrollByUser' => $enrollByUser,
      'topUser' => $this->DashboardRepository->getTopUser(),
      'lessUser' => $this->DashboardRepository->getLessUser()
    );

    return view('pages.dashboard',$content);
  }

    public function indexByUser()
    {
      return view('pages.dashboard');
    }



}
