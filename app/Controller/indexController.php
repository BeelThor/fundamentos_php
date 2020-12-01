<?php
namespace app\Controller;
use app\Model\ {Job,Project};
class indexController extends baseController{
    public function indexAction($request){
        
        $jobs = Job::all();
        $projects = Project::all();
       
        $name = 'Julián Berrío';
        $limitMonths = 2000;
      
        return $this->renderHTML('index.twig', [
            'name' => $name,
            'jobs' =>$jobs,
            'projects' => $projects
        ]);
    }
   
}
?>