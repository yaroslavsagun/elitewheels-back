<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TypeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TypeResource::collection(Type::all());
    }

    public function show(Type $type): TypeResource
    {
        return new TypeResource($type);
    }
}
