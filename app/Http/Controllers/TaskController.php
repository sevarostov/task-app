<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskController extends Controller {
	protected static $model = Task::class;

	/**
	 * Display a listing of the resource.
	 *
	 * @return JsonResponse
	 */
	public function index(): JsonResponse {
		try {
			$tasks = self::$model::all();

			return response()->json($tasks, ResponseAlias::HTTP_OK);
		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
				'details' => $e->getMessage()],
				status: $e->getCode());
		}
	}

	/**
	 * Creating a new resource.
	 */
	public function store(TaskRequest $request) {
		try {
			$newTask = self::$model::create($request->all());

			return response()->json($newTask, ResponseAlias::HTTP_CREATED);
		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
				'details' => $e->getMessage()],
				status: $e->getCode());
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Task $task) {
		try {
			$task = self::$model::findOrFail($task->id);

			return response()->json($task, ResponseAlias::HTTP_OK);
		} catch (ModelNotFoundException $e) {
			return response()->json([
				'message' => $e->getMessage(),
				'details' => $e->getMessage()],
				status: $e->getCode());
		}
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(TaskRequest $request, string $id) {
		try {
			$task = self::$model::findOrFail($id);
			$task->fill($request->all());

			if (!$task->save()) {
				throw new \Exception("Bad Request", ResponseAlias::HTTP_BAD_REQUEST);
			}

			return response()->json($task, ResponseAlias::HTTP_OK);
		} catch (ModelNotFoundException|\Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
				'details' => $e->getMessage()],
				status: $e->getCode());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Task $task) {
		try {
			$task = self::$model::findOrFail($task->id);
			$task->delete();

			return response()->json(['message' => 'Success'], ResponseAlias::HTTP_OK);
		} catch (ModelNotFoundException|\Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
				'details' => $e->getMessage()],
				status: $e->getCode());
		}
	}
}
