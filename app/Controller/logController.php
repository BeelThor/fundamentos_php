<?php
namespace app\Controller;
use app\Model\User;
use Laminas\Diactoros\Response\RedirectResponse;
class logController extends baseController{
    public function getLogIn(){
        return $this->renderHTML('login.twig');
    }
    public function postLogIn ($request){
        $message = null;
        $data = $request->getParsedBody();
        $user = User::where('Email',$data['Email'])->first();
        if($user){
            if(\password_verify($data['Password'], $user->Password)){
                $_SESSION['UserId']= $user->id;
                return new RedirectResponse('/fundamentos_php2018'); 
                
            }else{
                $message = 'Bad Credentials';
            }
        }else{
            $message = 'Bad Credentials';
        }
        return $this->renderHTML('login.twig',[
            'message' => $message
        ]);
    }
    public function getLogOut(){
        unset($_SESSION['UserId']);
        return new RedirectResponse('/fundamentos_php2018/login');
    }

}
?>