<?php

namespace App\Enum;

/**
 * Статус задачи
 */
enum Status: string {

	/**
	 * Новая
	 */
	case New = "new";

	/**
	 * В работе
	 */
	case InWork = "in_work";

	/**
	 * Закрыта
	 */
	case Closed = "closed";

	/**
	 * Переоткрыта
	 */
	case Reopened = "re_opened";
}
