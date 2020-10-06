<?php
namespace Project\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class ProjectTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getProject($project_id)
    {
        $project_id = (int) $project_id;
        $rowset = $this->tableGateway->select(['project_id' => $project_id]);
        $row = $rowset->current();
        if (! $row) { 
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $project_id
            ));
        }

        return $row;
    }

    public function saveProject(Project $project)
    {
        $data = [
            'project_id'    => $project->project_id,
            'title'         => $project->title,
            'start_date'    => $project->start_date,
            'complete'      => $project->complete
        ];

        $project_id = (int) $project->project_id;

        if ($project_id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getProject($project_id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $project_id
            ));
        }

        $this->tableGateway->update($data, ['project_id' => $project_id]);
    }

    public function deleteProject($project_id)
    {
        $this->tableGateway->delete(['project_id' => (int) $project_id]);
    }
}
?>