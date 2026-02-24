<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Storage;

class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __destruct(){
        
//        \App\Helpers\LogActivity::addToLog();
    }//end function __destruct.

    public  function storeImage($folderName,$file){
        try{
            return Storage::disk('website')->put($folderName, $file);
        }catch(\Exception $e){
        	return '';
        }//end trycatch.
	}//end storeImage function.
    public  function storeImageToStorageFolder($folderName,$file){
        try{
            return Storage::disk('storage')->put($folderName, $file);
        }catch(\Exception $e){
        	return '';
        }//end trycatch.
	}//end storeImageToStorageFolder function.
    public function deleteImage($file){
        try{
            return Storage::disk('website')->delete($file);
        }catch(\Exception $e){
        	return '';
        }//end trycatch.
	}//end storeImage function.

    public function sendWelcomeEmailWithLoginDetails($user, $password){
        $url = env('APP_URL');
        $password = $password ?? 'not provided';
        $message = "Dear {$user->name},\n\nYour Account has been created.\n\nYour email: {$user->email},\n\npassword: {$password}\n\n Thank You\n\n";
        $subject = 'Welcome to LeadUp';
        Mail::raw($message, function ($emailMessage) use ($user, $subject) {
            $emailMessage->to($user->email)
                ->cc('development.aftab@gmail.com')
                ->subject($subject);
        });
    }
}//end class.
