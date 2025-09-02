<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Todo::query();

        // Filter by userId if provided
        if ($request->has('userId')) {
            $query->where('userId', $request->userId);
        }

        // Pagination
        $limit = $request->get('limit', 10);
        $skip = $request->get('skip', 0);

        $todos = $query->skip($skip)->take($limit)->get();

        return response()->json(new TodoCollection($todos));
    }

    /**
     * Get todos by user ID.
     *
     * @param  int  $userId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTodosByUser(int $userId, Request $request): JsonResponse
    {
        // Pagination
        $limit = $request->get('limit', 10);
        $skip = $request->get('skip', 0);

        $todos = Todo::where('userId', $userId)
            ->skip($skip)
            ->take($limit)
            ->get();

        return response()->json(new TodoCollection($todos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'todo' => 'required|string|max:1000',
            'completed' => 'boolean',
            'userId' => 'required|integer|min:1',
        ]);

        $todo = Todo::create($validated);

        return response()->json(new TodoResource($todo), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);

        return response()->json(new TodoResource($todo));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $todo = Todo::findOrFail($id);

        $validated = $request->validate([
            'todo' => 'sometimes|required|string|max:1000',
            'completed' => 'sometimes|boolean',
            'userId' => 'sometimes|required|integer|min:1',
        ]);

        $todo->update($validated);

        return response()->json(new TodoResource($todo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json([
            'id' => $id,
            'deleted' => true,
        ]);
    }
}
