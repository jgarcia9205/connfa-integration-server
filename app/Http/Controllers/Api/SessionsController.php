<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\EventRepository;
use App\Transformers\EventTransformer;
use App\Transformers\Event\SessionTransformer;

class SessionsController extends ApiController
{
    public function index(EventRepository $repository)
    {
        $events = $repository->getEventsByTypeWithDeleted('program', $this->since);
        $this->checkModified($events);

        $transformer = new EventTransformer();
        $transformer->embeddedTransformer = new SessionTransformer();

        return $this->response->array($transformer->transform($events));
    }
}