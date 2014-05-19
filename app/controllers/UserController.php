<?php
 
class UserController
  extends Controller
{
  
 
  public function login()
  {
    //die("I'm here!");
    $data = [];
    // the form comes from post
    if ($this->isPostRequest()) {
      $validator = $this->getLoginValidator();
      //all the fields are completed
      if ($validator->passes()) {
        $credentials = $this->getLoginCredentials();
        if (Auth::attempt($credentials)) {
          return Redirect::route("user/profile");
        }
        //if credentials don't match
        return Redirect::back()->withErrors([
          "password" => ["Credentials invalid."]
        ]);
      }else {
        //if some of the fields are not completed/valid
        return Redirect::back()
          ->withInput()
          ->withErrors($validator);
      }
    }
    //show the login form
    return View::make("user/login", $data);
  }
  
  protected function isPostRequest()
  {
  	return Input::server("REQUEST_METHOD") == "POST";
  }
  
  protected function getLoginValidator()
  {
    return Validator::make(Input::all(), [
      "username" => "required",
      "password" => "required"
    ]);
  }
  protected function getLoginCredentials()
  {
    return [
      "username" => Input::get("username"),
      "password" => Input::get("password")
    ];
  }
  //redirects to the user's profile
  public function profile()
  {
    return "Taytus";
  //return View::make("user/profile");
  }

  ////password management
  public function request()
{

  if ($this->isPostRequest()) {
    $response = $this->getPasswordRemindResponse();
  
    if ($this->isInvalidUser($response)) {
      return Redirect::back()
        ->withInput()
        ->with("error", Lang::get($response));
    }
   die("is not getting the post!");
    return Redirect::back()
      ->with("status", Lang::get($response));
  }
  
  return View::make("user/request");
}
  
protected function getPasswordRemindResponse()
{
  return Password::remind(Input::only("email"));
}
  
protected function isInvalidUser($response)
{
  return $response === Password::INVALID_USER;
}


///////////reset

public function reset($token)
{
  if ($this->isPostRequest()) {
    $credentials = Input::only(
      "email",
      "password",
      "password_confirmation"
    ) + compact("token");
 
    $response = $this->resetPassword($credentials);
 
    if ($response === Password::PASSWORD_RESET) {
      return Redirect::route("user/profile");
    }
 
    return Redirect::back()
      ->withInput()
      ->with("error", Lang::get($response));
  }
 
  return View::make("user/reset", compact("token"));
}
 
protected function resetPassword($credentials)
{
  return Password::reset($credentials, function($user, $pass) {
    $user->password = Hash::make($pass);
    $user->save();
  });
}
///logout method
  public function logout()
  {
    Auth::logout();
    
    return Redirect::route("user/login");
  }
}