<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Задача
 *
 * @property int $id Идентификатор
 * @property string $title Наименование
 * @property string $description Описание
 * @property string $status Статус
 */
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

	protected $fillable = [
		'title',
		'description',
		'status'
	];
}
