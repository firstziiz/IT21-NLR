<?php

namespace App\Http\Controllers;

use App\Repositories\BookingRepositoryInterface;
use Illuminate\Http\Request;
use Auth;

class BookingController extends MainController
{

  protected $SectionRepository;

  public function __construct(BookingRepositoryInterface $BookingRepository)
  {
    parent::__construct();
    $this->BookingRepository = $BookingRepository;
  }

  public function index($section = null)
  {
    $section = $this->BookingRepository->getSection($section);

    $content = array(
      'section' => $section,
      'user' => Auth::user()
    );

    return view('pages.booking',$content);
  }

  public function bookingSeat(Request $request){
    $user = Auth::user();
    $data = $request->all();

    if($this->BookingRepository->validateBooking($data) > 0)
      return array('reserved'=>true);

    if($this->BookingRepository->validateDayBooking($user,$data) > 0)
      return array('isday'=>true);


    $result = $this->BookingRepository->booking($user,$data);
    return array('done'=>true);
  }

  public function cancelSeat(Request $request){
    $user = Auth::user();
    $data = $request->all();

    if ($this->BookingRepository->cancelSeat($user,$data)) {
      return array('done'=>true);
    }
    return array('error'=>true);
  }
}
