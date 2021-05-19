<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function users()
    {
        $users = DB::table('users')->paginate(10);

        return view(
            'users.index',
            [
                'users' => $users

            ]
        );
        
    }

    public function update(Request $req)
    {
  
        $user= DB::table('users');
      
        
              DB::table('users')
                            ->where('id', $req->id)
                            ->update(
                               ['name'=>$req->name ,'email'=>$req->email ,'role'=>$req->role]);
  
    }

    public function updateBoards(Request $req)
    {
  
        
   
  
              DB::table('boards')
                            ->where('id', $req->id)
                            ->update(
                               ['name'=>$req->name ,
                               'user_id'=>$req->user_id ,
                               'created_at'=>$req->created_at,
                                'updated_at'=>$req->updated_at]);
  
                               
    }


   
    public function destroy($id)
    {   
        
        
         DB::delete('delete from users where id = ?' ,[$id]);

  

    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function updateUser(Request $request): RedirectResponse
    {
        $error = '';
        $success = '';

        if ($request->has('id')) {
            /** @var User $user */
            $user = User::find($request->get('id'));

            if ($user) {
                $role = $request->get('role');

                if (in_array($role, [User::ROLE_USER, User::ROLE_ADMIN])) {
                    $user->role = $role;
                    $user->save();

                    $success = 'User saved';
                } else {
                    $error = 'Role selected is not valid!';
                }
            } else {
                $error = 'User not found!';
            }
        } else {
            $error = 'Invalid request';
        }

        return redirect()->back()->with([
            'error' => $error, 'success' => $success
        ]);
    }

    /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function updateUserAjax(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

        $error = '';
        $success = '';

        if ($user) {
            $role = $request->get('role');

            if (in_array($role, [User::ROLE_USER, User::ROLE_ADMIN])) {
                $user->role = $role;
                $user->save();
                $user->refresh();

                $success = 'User saved';
            } else {
                $error = 'Role selected is not valid!';
            }
        } else {
            $error = 'User not found!';
        }

        return response()->json(['error' => $error, 'success' => $success, 'user' => $user]);
    }

    /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function deleteUser(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

        $error = '';
        $success = '';

        if ($user) {
            $user->delete();

            $success = 'User deleted';
        } else {
            $error = 'User not found!';
        }

        return response()->json(['error' => $error, 'success' => $success]);
    }
}