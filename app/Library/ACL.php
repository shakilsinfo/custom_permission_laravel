<?php 
namespace App\library {
use Auth;
use DB;
use URL;
use Image;
use Session;
use Route;
use App\Models\UserRole;
use App\Models\ControllerNames;
class ACL {


	public static function getAllController()
	{
		$controllerNames = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {

                $_action = explode('@',$action['controller']);
                $_namespaces_chunks = explode('\\',$_action[0]);

                $controllerNames[end($_namespaces_chunks)] = end($_namespaces_chunks);
                
                //$controllers[$i]['action'] = end($_action);
                // $controllers[$i]['namespace'] = $action['controller'];
                // $controllers[$i]['route'] = $route;
            }
            
        }

        return $controllerNames;
	}
	public static function getControllerRoute()
	{
		$routeName = [];
		$routeCollection = Route::getRoutes();

		foreach ($routeCollection as $value) {
		    $routeName[$value->uri()] =  $value->uri();
		    // echo "<pre>";
		    // print_r($value);
		}

        return $routeName;
	}
	public static function userWisePermissionSelection($display_action=false,$custom_controller_name=false)
	{
		if(Auth::user()->id != 1){

			$dbUserWiseAccessInfoArr = json_decode(Session::get('userAccessData'), true);
			//$dbUserWiseAccessInfoArr = json_decode(Auth::user()->userTypeObj->user_role, true);

			if($custom_controller_name == true){
				$controller_name = $custom_controller_name;
			}else{
				$controller_name = Session::get('currentControllerName');
			}

			// For Checking Have Any Access Or Not
			if($display_action == false){
				if(isset($dbUserWiseAccessInfoArr[$controller_name])){
					if(isset($dbUserWiseAccessInfoArr[$controller_name]['view']) || isset($dbUserWiseAccessInfoArr[$controller_name]['add_edit']) || isset($dbUserWiseAccessInfoArr[$controller_name]['delete'])){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}

			// For Checking Add / Edit Permission or Not
			if($display_action == "add_edit"){
				if(isset($dbUserWiseAccessInfoArr[$controller_name]['add_edit'])){
					return true;
				}else{
					return false;
				}
			}

			// For Checking Delete Permission or Not
			if($display_action == "delete"){
				if(isset($dbUserWiseAccessInfoArr[$controller_name]['delete'])){
					return true;
				}else{
					return false;
				}
			}				 

			// For Checking Delete Permission or Not
			if($display_action == "view"){
				if(isset($dbUserWiseAccessInfoArr[$controller_name]['view'])){
					return true;
				}else{
					return false;
				}
			}

		}else{
			return true;
		}
		
	}

	public static function layoutUrlPathAccess(){
		$getControllerList = ControllerNames::get();
	}

}
}
?>