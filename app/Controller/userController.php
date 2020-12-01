<?php
namespace app\Controller;
use app\Model\{User};
use Respect\Validation\Validator as v;
class userController extends baseController{
    public function userAddAction($request){
        $message = null;
        if($request->getMethod()== 'POST'){
           $data = $request->getParsedBody();
           $userValidator = v::key('UserName', v::stringType()->notEmpty())
            ->key('Email', v::stringType()->notEmpty())
            ->key('password', v::stringType()->notEmpty());
            try{
                $userValidator->assert($data);
                $user = new User;
                $user->UserName = $data['UserName'];
                $user->Email = $data['Email'];
                $user->Password = password_hash($data['password'],PASSWORD_DEFAULT);
                $user->save();
                $message = 'Saved';
            }catch(\Exception $e){
                $message = $e->getMessage();
            };
        }

        return $this->renderHTML('createUser.twig',[
            'message' => $message
        ]);
    }
}
?>