<?php

namespace App\Http\Controllers;



use App\Models\Task;
use App\Models\Board;
use App\Models\BoardUser;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

     //
      /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function updateTask(Request $request, $id): JsonResponse
    {
  

                /** @var User $user */
                    $user = Auth::user();

               
            

                        $Task = Task::find($id);
                        
                      
                        $error = '';
                        $success = '';
                    
                        if ($Task) 
                        {
                            $name=$request->name;
                            $description=$request->description;
                            $assignment=$request->assignment; 
                            $status=$request->status;
                           


                            $Task->name =$name;
                            $Task->description =$description;
                           
                            if($user_id = User::where('name', $assignment)->value('id'))
                            
                            {

                                $Task->assignment=$user_id;

                            }
              
                            $Task->status =$status;
                           


                            $Task->save();
                            $Task->refresh();

                            $success = 'Task saved';
                        }
                        else
                         {
                            $error = 'Task not found!';
                        }


                        $tasks=Task::query();

                       
                 
                          $tasks=$tasks->select('name','assignment')->get();


                          $users=User::query();

                        
                   
                            $users=$users->select('id','name')->get();
                        


                        //  return view(
                        //     'boards.index',
                        //     [
                        //        // 'boards' => $boards,
                        //       //'users'=>$users,
                        //       //  'tasks'=>$tasks,
                                
                
                        //     ]
                        //     );


                       return response()->json(['error' => $error, 'success' => $success, 'task' => $Task]);


    }





  /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function deleteTask (Request $request,$id): JsonResponse
    {

     

     /** @var User $user */
 $user = Auth::user();
 if($user->id==$request->IdCreator || $user->role === User::ROLE_ADMIN)
 {
  
         $Task = Task::find($id);
        
         $error = '';
         $success = '';

         if ($Task) 
         {
          
             $Task->delete();

             $success = 'Task deleted';
        } else 
         {
             $error = 'Task not found!';
         }


       

          return response()->json(['error' => $error, 'success' => $success]);
    
 };

}



}