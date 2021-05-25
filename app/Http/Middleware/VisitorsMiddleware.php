<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



class VisitorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     
     * @return View|RedirectResponse|Redirector|mixed
     * @return 
     */
    public function handle(Request $request, Closure $next)
    {
$PentruData = Carbon::now()->format('d-m-Y');

$AuthUser = Auth::user();

$IdVizitator = Visitor::where('user_id', '=', $AuthUser->id)->where('visited_date' ,'=',Carbon::now()->format('d-m-Y'))->first(); 
if ($IdVizitator === null) {


Visitor::create(['user_id' => $AuthUser->id, 'name' => $AuthUser->name, 'visited_date' => Carbon::now()->format('d-m-Y'), 'visits' => '1']);
   
} else 
{

$IdVizitator = Visitor::where('user_id', '=', $AuthUser->id)->where('visited_date','=',Carbon::now()->format('d-m-Y'))->first();

Visitor::where('user_id', $AuthUser->id)->where('visited_date', Carbon::now()->format('d-m-Y'))->increment('visits','1',['visited_date'=>now()->format('d-m-Y')]);
if(!$IdVizitator)
{

Visitor::create(['user_id' => $AuthUser->id, 'name' => $AuthUser->name, 'visited_date' => Carbon::now()->format('d-m-Y'), 'visits' => '1']);

}
     
}


 return $next($request);
    }
}
