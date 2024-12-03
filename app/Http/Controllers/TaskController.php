<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class TaskController extends Controller
{
    // Muestra una lista de tareas junto con las categorías
    public function index(Request $request)
    {
        $tasks = Task::with('category')->get(); // Obtener tareas con categorías relacionadas
        $categories = Category::all();

        return view('dashboard', compact('tasks', 'categories'));
    }

    // Crea una nueva tarea
    public function createTask(Request $request)
{
    $task = $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|string|max:1000',
        'id_category' => 'required|exists:categories,id',
        'completed' => 'nullable|boolean', // Hacer que completed sea opcional
    ]);

    // Si no se envió un valor para 'completed', asignar 'false' por defecto
    $task['completed'] = $task['completed'] ?? false;

    Task::create($task);

    return redirect()->route('dashboard')->with('success', 'Tarea creada correctamente');
}


    // Muestra una tarea específica
    public function showTask($id)
    {
        $task = Task::findOrFail($id);
        $categories = Category::all();

        return view('edit_task', compact('task', 'categories'));
    }

    // Actualiza una tarea
    public function updateTask(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string|max:1000',
            'id_category' => 'required|exists:categories,id',
            'completed' => 'boolean',
        ]);

        Task::where('id', $id)->update($validate);

        return redirect()->route('dashboard')->with('success', 'Tarea actualizada correctamente');
    }

    public function markAsCompleted($id) {
    $task = Task::findOrFail($id);
    $task->completed = true;  // Marcar como completada
    $task->save();

    return redirect()->route('dashboard')->with('success', 'Task marked as completed!');
    }


    // Elimina una tarea
    public function deleteTask($id)
    {
        Task::destroy($id);

        return redirect()->route('dashboard')->with('success', 'Tarea eliminada correctamente');
    }
}
