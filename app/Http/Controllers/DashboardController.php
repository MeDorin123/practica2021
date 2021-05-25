<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\Task;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
      //Salut, am incercat sa instalez https: //github.com/antonioribeiro/tracker
      // pentru statistici dar nu am reusit..
      //asa ca am incercat sa fac un tabel separat pentru vizitatori

      
      //zilele
$sixdaysago = Carbon::now()->subDays(6)->format('d');
$fivedaysago = Carbon::now()->subDays(5)->format('d');
$fourdaysago = Carbon::now()->subDays(4)->format('d');
$threedaysago = Carbon::now()->subDays(3)->format('d');
$Otherday = Carbon::now()->subDays(2)->format('d');
$Yesterday = Carbon::yesterday()->format('d');
$today = Carbon::now()->format('d');

      
    
//totalul vizitatorilor pe zile
$VizitatoriSixdaysago = Visitor::query('visitors')->where('visited_date', '=', Carbon::now()->subDays(6)->format('d-m-Y'))->count();
$VizitatoriFivedaysago = Visitor::query('visitors')->where('visited_date', '=', Carbon::now()->subDays(5)->format('d-m-Y'))->count();
$VizitatoriFourdaysago = Visitor::query('visitors')->where('visited_date', '=', Carbon::now()->subDays(4)->format('d-m-Y'))->count();
$VizitatoriThreedaysago = Visitor::query('visitors')->where('visited_date', '=', Carbon::now()->subDays(3)->format('d-m-Y'))->count();
$VizitatoriOtherday = Visitor::query('visitors')->where('visited_date','=',Carbon::now()->subDays(2)->format('d-m-Y'))->count();
$VizitatoriYesterday = Visitor::query('visitors')->where('visited_date','=',Carbon::yesterday()->format('d-m-Y'))->count();
$VizitatoriToday = Visitor::query('visitors')->where('visited_date','=',Carbon::today()->format('d-m-Y'))->count();


$totalVizitatori = Visitor::distinct()->get('user_id')->count(); //Vizitatorii din table care nu au user_id la fel



//totalul vizitelor pe zile
$ViziteSixdaysago = Visitor::where('visited_date', '=',Carbon::now()->subDays(6)->format('d-m-Y'))->sum('visits');
$ViziteFivedaysago = Visitor::where('visited_date', '=', Carbon::now()->subDays(5)->format('d-m-Y'))->sum('visits');
$ViziteFourdaysago = Visitor::where('visited_date', '=',Carbon::now()->subDays(4)->format('d-m-Y'))->sum('visits');
$ViziteThreedaysago = Visitor::where('visited_date', '=', Carbon::now()->subDays(3)->format('d-m-Y'))->sum('visits');
$ViziteOtherday = Visitor::where('visited_date', '=',Carbon::now()->subDays(2)->format('d-m-Y'))->sum('visits');
$ViziteYesterday = Visitor::where('visited_date', '=', Carbon::yesterday()->format('d-m-Y'))->sum('visits');
$ViziteToday = Visitor::where('visited_date', '=', Carbon::today()->format('d-m-Y'))->sum('visits');


$ViziteTotal = Visitor::sum('visits');//Vizitele totale


/** @var Task $task */


$Nrtask =Task::where('assignment', '>', '0')->count();


    $user = Auth::user();
     if ($user->role === User::ROLE_ADMIN)
     {
        $users=User::count();
        $boards=Board::count();
//numarul de taskuri asignate 

        return view('dashboard.index', [
            'users' => $users,
            'boards'=>$boards,
            'Nrtask' => $Nrtask,
            'totalVizitatori' => $totalVizitatori,

// ziele 
            'sixdaysago'=>$sixdaysago,
            'fivedaysago'=>$fivedaysago,
            'fourdaysago'=>$fourdaysago,
            'threedaysago'=>$threedaysago,
            'Otherday'=>$Otherday,
            'Yesterday'=>$Yesterday,
            'today'=>$today,

//vizitatorii pe zile


'VizitatoriSixdaysago'=>$VizitatoriSixdaysago,
'VizitatoriFivedaysago'=>$VizitatoriFivedaysago,
'VizitatoriFourdaysago'=>$VizitatoriFourdaysago,
'VizitatoriThreedaysago'=>$VizitatoriThreedaysago,
'VizitatoriOtherday'=>$VizitatoriOtherday,
'VizitatoriYesterday'=>$VizitatoriYesterday,
'VizitatoriToday'=>$VizitatoriToday,

//vizitele

'ViziteSixdaysago'=>$ViziteSixdaysago,
'ViziteFivedaysago'=>$ViziteFivedaysago, 
'ViziteFourdaysago'=>$ViziteFourdaysago,
'ViziteThreedaysago'=>$ViziteThreedaysago, 
'ViziteOtherday'=>$ViziteOtherday,
'ViziteYesterday'=>$ViziteYesterday,
'ViziteToday'=>$ViziteToday,
'ViziteTotal'=>$ViziteTotal

            ]);
     }

     else 
     {
                
                if ($user->role === User::ROLE_USER) 
                {
                    /** @var Task $task */

                    $tasks = Task::where('assignment', $user->id)->count(); 

                
                    $IdBoards = Board::where('user_id', $user->id)->value('user_id');  


                    $boards = Board::query();


                    $users = User::count(); 

                    $boards=Board::where('user_id', $user->id)->count();


                    return view('dashboard.index', [
                        'users' => $users,
                        'boards' => $boards,
                        'Nrtask' => $Nrtask,
                        'totalVizitatori' => $totalVizitatori]);


                }
     }


}

}
