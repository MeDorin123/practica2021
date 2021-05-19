<?php

namespace App\Http\Controllers;




use App\Models\Board;
use App\Models\Task;
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
/**
 * Class BoardController
 *
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function boards()
    {
        /** @var User $user */
        $user = Auth::user();

        $boards = Board::with(['user', 'boardUsers','tasks']);
     

         if ($user->role === User::ROLE_USER) {
             $boards = $boards->where(function ($query) use ($user) {
                 //Suntem in tabele de boards in continuare
                 $query->where('user_id', $user->id)
          
                 ->orWhereHas('boardUsers', function ($query) use ($user) {
                    //Suntem in tabela de board_users

                     $query->where('user_id', $user->id);
                })

               
                ->orWhereHas('tasks', function ($query) use ($user) {
                    //Suntem in tabela de board_users

                     $query->where('assignment', $user->id);
                });
        });
        




         }

  /** @var Task $tasks */
  $tasks = Task::query();
  $tasks=$tasks->select('id','name','assignment')->get();

         $users=User::query();

         
  
           $users=$users->select('id','name')->get();


        $boards = $boards->paginate(10);

        return view(
            'boards.index',
            [
                'boards' => $boards,
                'users'=>$users,
                'tasks'=>$tasks,
                

            ]
        );
    }

      /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function updateBoard(Request $request, $id): JsonResponse 
    
    {
  

        /** @var User $user */
            $user = Auth::user();
        if($user->id==$request->IdUserCreator || $user->role === User::ROLE_ADMIN)
        {
            
            $error = '';
            $success = '';
        
                $board = Board::find($id);
                //$Task = Task::query();


               if($board)
               
               {

                $name=$request->name;
                $board->name =$name;
                 $board->save();
                 $board->refresh();
    
              
                 $success = 'Board saved';



               }



                    else 
                    {

                        $error = 'Board not found!';
                    }

         
        

      
      
         }
                

        return response()->json(['error' => $error, 'success' => $success, 'board' => $board]);
        
    

    


    
 }
    /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function deleteBoard(Request $request,$id): JsonResponse
    {

    /** @var User $user */
    $user = Auth::user();
    
    if($user->id==$request->DeleteIdUserCreator || $user->role === User::ROLE_ADMIN)
    {//Functioneaza doar daca boardul nu are task

      
    
    

        $board = Board::find($id);
      //  $tasks=Task::find($id);
        
        $error = '';
        $success = '';

        if ($board) 
        {
          
       
 //$tasks->delete();
 //DB::table('tasks')->where('board_id ', '==', $id)->delete();

//$table->foreign('user_id')->references('id')->on('boards')->onDelete('cascade');

      $board->delete();

            $success = 'Board deleted';



        
        } 
        else 
        {
            $error = 'Board not found!';
        }

       

         return response()->json(['error' => $error, 'success' => $success]);
    
    }


    }

   
    /**
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function board($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $boards = Board::query();

         /** @var Task $tasks */
        $tasks = Task::query();

        if ($user->role === User::ROLE_USER) {
            $boards = $boards->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                     ->orWhereHas('boardUsers', function ($query) use ($user) {
                         $query->where('user_id', $user->id);
                     })

                    ->orWhereHas('tasks', function ($query) use ($user) {
                        //Suntem in tabela de board_users
    
                         $query->where('assignment', $user->id);
                    });
            });
        }

        $board = clone $boards;
        $users=User::query();

       

         $users=$users->select('id','name')->get();
            
     
      

        $board=$board->where('id',$id)->first();//
      
        $boards=$boards->select('id','name')->get();
        
        
    
    //Ordonarea
   
        $tasks=$tasks->select('id','board_id','name','description','assignment','status','created_at')->orderBy('created_at','DESC')->where('board_id',$id)->get();

       
       
        if (!$board) {
            return redirect()->route('boards.all');
        }



        return view(
            'boards.view',
            [
                'board' => $board,
                'boards' => $boards,
                'tasks'=>$tasks,    
                'users'=>$users,
            ]

         
        );
    
    
    }



}