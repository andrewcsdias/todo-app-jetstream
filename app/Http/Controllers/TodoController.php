<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Todo/Index', [
            'todos' => Todo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Todo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        Validator::make($request->all(), [
            'nome' => ['required', 'min:10', 'max:255'],
        ])->validate();

        Todo::create($request->all());

        return to_route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return Inertia::render('Todo/Edit', [
            'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        Validator::make($request->all(), [
            'nome' => ['required', 'min:10', 'max:255'],
        ])->validate();
        
        $todo->update($request->all());

        return to_route('todos.index', [
            'todos' => Todo::all(),
        ]);

        /*return to_route('todos.edit', [
            'todo' => $todo
        ]);*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        
        return to_route('todos.index');
    }
}
