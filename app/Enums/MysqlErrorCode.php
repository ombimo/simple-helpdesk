<?php

namespace App\Enums;

enum MysqlErrorCode: int
{
    case INTEGRITY_CONSTRAINT_VIOLATION = 23000;
}
