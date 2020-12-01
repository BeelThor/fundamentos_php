<?php
namespace app\Controller;

use app\Model\Project;
class projectController extends BaseController {
    public function projectAddAction($request){
        if($request->getMethod()=='POST'){
            $data = $request->getParsedBody();
            $project = new Project;
            $project->title = $data['title'];
            $project->description = $data['description'];
            $project->save();
        }
        return $this->renderHTML('addProject.twig');
    }

}
?>