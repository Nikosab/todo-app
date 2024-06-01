<?php

namespace App;

class TodoManager
{
    private $filePath = __DIR__ . '/../todos.json';

    public function getTodos()
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $json = file_get_contents($this->filePath);
        return json_decode($json, true) ?? [];
    }

    public function saveTodos($todos)
    {
        file_put_contents($this->filePath, json_encode($todos, JSON_PRETTY_PRINT));
    }

    public function addTodo($description)
    {
        $todos = $this->getTodos();
        $todos[] = ['description' => $description, 'state' => 'pending'];
        $this->saveTodos($todos);
    }

    public function completeTodo($index)
    {
        $todos = $this->getTodos();
        if (isset($todos[$index])) {
            $todos[$index]['state'] = 'completed';
            $this->saveTodos($todos);
        }
    }

    public function deleteTodo($index)
    {
        $todos = $this->getTodos();
        if (isset($todos[$index])) {
            array_splice($todos, $index, 1);
            $this->saveTodos($todos);
        }
    }
}
