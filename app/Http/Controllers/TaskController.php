<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Return paginated tasks for the authenticated user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //todo: get tasks for the authenticated user
        $tasks = Task::paginate(5);
        return TaskResource::collection($tasks);
    }


    /**
     * Return a task by id
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }
    /**
     * Sava a new task in the database
     * @param NewTaskRequest $request
     * @return TaskResource
     */
    public function store(NewTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return new TaskResource($task);
    }

    /**
     * Update an existing task
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return TaskResource
     */
    public function update(UpdateTaskRequest $request, Task $task){
        $validated = $request->validated();
        $task->update([
            'title' => $validated['title'] ?? $task->title,
            'description' => $validated['description'] ?? $task->description,
            'status' => $validated['status'] ?? $task->status,
            'category_id' => $validated['category_id'] ?? $task->category_id,
            'user_id' => $task->user_id
        ]);
        return new TaskResource($task);
    }

    /**
     * Soft delete a task
     * @param Task $task
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function delete(Task $task)
    {
        $task->delete();
        return response(null, 204);
    }

    /**
     * Restore a single soft deleted task
     * @param Task $task
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->restore();
        return response(null, 204);
    }
}
