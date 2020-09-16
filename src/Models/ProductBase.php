<?php

namespace bachphuc\Shopy\Models;

use Illuminate\Database\Eloquent\Model;

use bachphuc\PhpLaravelHelpers\WithModelBase;
use bachphuc\PhpLaravelHelpers\WithImage;

class ProductBase extends Model
{
    use WithModelBase, WithImage;
}