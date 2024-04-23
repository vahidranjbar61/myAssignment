<?php

namespace App\Dto;

class BookDto
{
    private int $id;
    private string $title;
    private string $author;
    private string $date;
    private string $status;
    public function __construct(
        int $id,
        string $title,
        string $author,
        string $date,
        string $status
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->date = $date;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'date' => $this->date,
            'status' => $this->status,
        ];
    }
}