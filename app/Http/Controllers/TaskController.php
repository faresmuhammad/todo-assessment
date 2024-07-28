<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Return paginated tasks for the authenticated user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->paginate(5);
        return TaskResource::collection($tasks);
    }

    /**
     * Return paginated soft deleted tasks for the authenticated user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function trashed()
    {
        $tasks = Task::onlyTrashed()->where('user_id', auth()->id())->paginate(5);
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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $task->update([
            'title' => $validated['title'] ?? $task->title,
            'description' => $validated['description'] ?? $task->description,
            'status' => $validated['status'] ?? $task->status,
            'category_id' => $validated['category_id'] ?? $task->category_id,
            'due_date' => $validated['due_date'] ?? $task->due_date,
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
     * Delete a task permanently
     * @param $id
     * @return ResponseFactory|Application|Response
     */
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->forceDelete();
        return response(null, 204);
    }

    /**
     * Restore a single soft deleted task
     * @param $id
     * @return ResponseFactory|Application|Response
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->restore();
        return response(null, 204);
    }

    /**
     * Return results that query matches title or description
     * @param string $query
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(string $query)
    {
        $results = Task::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")->paginate(5);
        return TaskResource::collection($results);
    }

    /**
     * Update status column to 'completed'
     * @param Task $task
     * @return TaskResource
     */
    public function completeTask(Task $task)
    {
        $task->update([
            'status' => 'completed'
        ]);
        return new TaskResource($task);
    }
}
