<?php
declare(strict_types=1);
namespace App\Control\Project\Grid;

use App\Control\Project\Grid\Control;

interface ControlFactory
{
    public function create(): Control;
}