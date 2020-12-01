<?php
namespace app\Controller;
use app\Model\{Job};
use Respect\Validation\Validator as v;

class jobController extends baseController{
public function jobAction($request){
    $message = null;
    if($request->getMethod()== 'POST'){
        $data = $request->getParsedBody();
        $jobValidator = v::key('title', v::stringType()->notEmpty())
        ->key('description', v::stringType()->notEmpty());
try{
    $jobValidator->assert($data);
    $job = new Job();
    $job->title = $data['title'];
    $job->description = $data['description'];
    $job->save();

    $message = 'Saved';

}catch(\Exception $e){
$message = ($e->getMessage());
}
   

    }
    return $this->renderHTML('addJob.twig',[
        'Message' => $message
    ]);
}

}
?>