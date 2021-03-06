<?php
namespace Project\Controller;

use Project\Form\ProjectForm;
use Project\Model\Project;
use Project\Model\ProjectTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProjectController extends AbstractActionController
{

    private $table;
    
    //
    public function __construct(ProjectTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel([
            'project' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new ProjectForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $project = new Project();
        $form->setInputFilter($project->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $project->exchangeArray($form->getData());
        $this->table->saveProject($project);
        return $this->redirect()->toRoute('project');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('project', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $project = $this->table->getProject($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('project', ['action' => 'index']);
        }

        $form = new ProjectForm();
        $form->bind($project);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($project->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveProject($project);

        // Redirect to album list
        return $this->redirect()->toRoute('project', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('project');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteProject($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('project');
        }

        return [
            'id'    => $id,
            'project' => $this->table->getProject($id),
        ];
    }
}

?>