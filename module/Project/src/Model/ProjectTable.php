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

    public function getProject($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) { 
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveProject(Project $project)
    {
        $data = [
            'id'    => $project->id,
            'title'         => $project->title,
            'st_date'    => $project->st_date,
            'complete'      => $project->complete
        ];

        $id = (int) $project->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getProject($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteProject($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
?>