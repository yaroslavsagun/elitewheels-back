<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CarController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Car::query();

        if ($request->has('brand_ids')) {
            $query->whereIn('brand_id', $request->input('brand_ids'));
        }

        if ($request->has('type_ids')) {
            $query->whereIn('type_id', $request->input('type_ids'));
        }

        if ($request->has('colors')) {
            $query->whereIn('color', $request->input('colors'));
        }

        if ($request->has('min_price') && $request->input('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->has('max_price') && $request->input('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        $cars = $query->paginate($request->input('per_page', 10), page: $request->input('page', 1));

        return CarResource::collection($cars);
    }

    public function myCars(): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();

        return CarResource::collection($user->cars);
    }

    public function store(Request $request): CarResource
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'type_id' => 'required|exists:types,id',
            'price' => 'required|numeric',
            'color' => 'required|string|max:255',
            'description' => 'string',
            'engine' => 'string',
            'time_to_100' => 'numeric',
            'max_speed' => 'integer',
            'max_power' => 'integer',
            'power_per_liter' => 'integer',
        ]);

        $car = Car::query()->create(array_merge(['user_id' => auth()->id()], $request->except(['images', 'main_image'])));

        if($mainImage = $request->file('main_image')) {
            $mainImagePath = $mainImage->store('car-images', 'public');
            $car->images()->create(['path' => $mainImagePath, 'is_main' => true]);
        }

        if($images = $request->file('images')) {
            foreach ($images as $image) {
                $imagePath = $image->store('car-images', 'public');
                $car->images()->create(['path' => $imagePath]);
            }
        }

        $car->save();

        return new CarResource($car);
    }

    public function show(Car $car): CarResource
    {
        return new CarResource($car);
    }

    public function update(Request $request, Car $car): CarResource
    {
        $request->validate([
            'name' => 'string|max:255',
            'brand_id' => 'exists:brands,id',
            'type_id' => 'exists:types,id',
            'price' => 'numeric',
            'color' => 'string|max:255',
            'description' => 'string',
            'engine' => 'string',
            'time_to_100' => 'numeric',
            'max_speed' => 'integer',
            'max_power' => 'integer',
            'power_per_liter' => 'integer',
        ]);

        $car->update($request->all());

        if($mainImage = $request->file('main_image')) {
            $car->images()->where('is_main', true)->delete();
            $mainImagePath = $mainImage->store('car-images', 'public');
            $car->images()->create(['path' => $mainImagePath, 'is_main' => true]);
        }

        if($images = $request->file('images')) {
            $car->images()->where('is_main', false)->delete();
            foreach ($images as $image) {
                $imagePath = $image->store('car-images', 'public');
                $car->images()->create(['path' => $imagePath]);
            }
        }

        $car->save();

        return new CarResource($car);
    }

    public function destroy(Car $car): JsonResponse
    {
        if($car->user_id !== auth()->id()) {
            return response()->json(['error' => 'You can delete only your cars'], Response::HTTP_FORBIDDEN);
        }

        $car->delete();

        return response()->json(['success' => true]);
    }
}
