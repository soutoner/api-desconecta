<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\Scheduling;
use App\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class SchedulingsController extends BaseController
{
    /**
     * Returns all the schedulings in the database.
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     * Creates a scheduling in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $scheduling = new Product();
        $scheduling->assign(
            [
            'end_period' => $request->get('end_period', 'string'),
            'period_type_id' => $request->get('period_type_id', 'strint'),
            ]
        );

        return $this->response($request, $scheduling, true);
    }

    /**
     * Updates a scheduling. Always use `x-www-form-urlencoded` content type for PUT.
     * @param $id - Id of the event to be updated
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $request = $this->request;

            $scheduling = Scheduling::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $scheduling->assign(
                [
                'id'               => $id,
                'end_period'       => $request->getPut('end_period', 'string', $scheduling->end_period),
                'period_type_id'   => $request->getPut('period_type_id', 'string', $scheduling->period_type_id),
                ]
            );

            return $this->response($request, $scheduling, true);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     * Deletes a scheduling from the database.
     *
     * @param  $id - Id of the pack to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $scheduling = Scheduling::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->response($this->request, $scheduling);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
