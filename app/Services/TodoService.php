<?php

namespace App\Services;

use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoService
{
    protected $order;

    /**
     * List orders
     * 
     * @return TodoResource 
     */
    public function list()
    {
        return TodoResource::collection(Todo::orderBy('created_at')->paginate(15));
    }

    /**
     * Create order
     * 
     * @param mixed $data 
     * @return \App\Model\Todo;
     */
    public function create($data)
    {
        try {
            $todo = Todo::create($data);
            return new TodoResource($todo);
        } catch (\Throwable $e) {
            return response()->json([
                "success" => false,
                "message" => $e,
                "data" => $data
            ], 400);
        }
    }

    /**
     * Update todo
     * 
     * @param mixed $todo
     * @param int $id
     * @return \App\Todo;
     */
    public function update($data, int $id)
    {
        try {
            $todo = Todo::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Not Found",
                "data" => $data
            ], 404);
        }

        try {
            $todo->update($data);
            return new TodoResource($todo);
        } catch (\Throwable $e) {
            return response()->json([
                "success" => false,
                "message" => $e,
                "data" => $data
            ], 400);
        }
    }

    /**
     * Update todo
     * 
     * @param int $id
     * @return \App\Todo;
     */
    public function delete(int $id)
    {
        try {
            $todo = Todo::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Not Found"
            ], 404);
        }

        try {
            $todo->delete();
            return new TodoResource($todo);
        } catch (\Throwable $e) {
            return response()->json([
                "success" => false,
                "message" => "Bad request"
            ], 400);
        }
    }

    /**
     * Return Order data
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $todo = Todo::findOrFail($id);
            return new TodoResource($todo);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Not Found"
            ], 404);
        }
    }
}
