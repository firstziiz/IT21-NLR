<?php

namespace App\Http\Controllers;

use App\Repositories\SectionRepositoryInterface;
use Auth;
use Illuminate\Http\Request;

class ReserveController extends Controller
{

  protected $SectionRepository;
  protected $user;

  public function __construct(SectionRepositoryInterface $SectionRepository)
  {
    $this->middleware('auth');
    $this->SectionRepository = $SectionRepository;
    $this->user = Auth::user();
  }

  public function index()
  {
    $sections = $this->SectionRepository->getSection();

    foreach ($sections as $section) {
      array_add($section,'enroll',[
      '1' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],1),
      '2' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],2),
      '3' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],3),
      '4' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],4),
      '5' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],5),
      '6' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],6),
      '7' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],7),
      '8' => $this->SectionRepository->getCountEnrollBySection($section['section_id'],8),
      ]);

      array_add($section,'remain',$this->SectionRepository->getSectionRemain($section['section_id']));
    }


    $content = array(
      'sections' => $sections,
      'user' => Auth::user()
    );

    return view('pages.reservation',$content);
  }
}
