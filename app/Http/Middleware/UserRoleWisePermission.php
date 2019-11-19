<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
use Route;
use App\Library\ACL;
class UserRoleWisePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);

        $currentControllerName = preg_replace('/.*\\\/', '', $controller);
        session(['currentControllerName'=>$currentControllerName]);

        if(Auth::user()->id != 1){  
            //Session Will Set Onces if user is not Admin 
            if(Session::has('userAccessData')==false){
                $userAccessData = Auth::user()->user_role_object->user_role;

                $hasAccess = 0;
                if($userAccessData != null){
                    $DbUserAccessData = json_decode($userAccessData, true);
                    foreach($DbUserAccessData as $fncAccess){
                        if(isset($fncAccess['view']) || isset($fncAccess['add_edit']) || isset($fncAccess['delete'])){
                           $hasAccess++; 
                        }
                    }
                }

                if($hasAccess == 0){
                    session()->flush();
                    session(['error'=> 'Access Denied ! You have not got access permission yet.']);
                    return redirect('login');
                }

                session(['userAccessData'=>$userAccessData]);
            }

            if($currentControllerName == "dashboardController"){
                return $next($request);
            }
        
            // It Takes two Parameter (1st = Action, 2nd = Controller)
            $result = ACL::userWisePermissionSelection();
            if($result==true){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return $next($request);
        }
    }
}
