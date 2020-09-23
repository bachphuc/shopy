<?php

namespace bachphuc\Shopy\Models;

use Illuminate\Database\Eloquent\Model;

use bachphuc\PhpLaravelHelpers\WithModelBase;
use bachphuc\PhpLaravelHelpers\WithImage;

use bachphuc\LaravelCustomFields\Trails\WithCustomField;

class ProductBase extends Model
{
    use WithModelBase, WithImage, WithCustomField;

    protected $thumbnailSizes = [120, 300, 500, 720];
}