<?php

namespace App\Services;

use App\Models\Unit;

class UnitService
{
    public function create($data)
    {
        $unit = Unit::create($data['basic']);
        $unit->update(['code' => $unit->id + 17000]);
        if (isset($data['extra'])) {
            $unit->unitData()->create($data['extra']);
        }
        if (isset($data['pools'])) {
            $unit->pools()->attach($data['pools']);
        }
        if (isset($data['views'])) {
            $unit->views()->attach($data['views']);
        }
        if (isset($data['toilets'])) {
            $unit->toilets()->attach($data['toilets']);
        }
        if (isset($data['kitchens'])) {
            $unit->kitchens()->attach($data['kitchens']);
        }
        if (isset($data['fromDate'])) {
            foreach ($data['fromDate'] as $key => $element) {
                $unit->times()->create([
                    'from' => $element,
                    'to' => $data['toDate'][$key],
                    'price' => $data['price'][$key],
                    'availability' => $data['availability'][$key],
                ]);
            }
        }
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $unit->addMedia($image)->toMediaCollection('images');
            }
        }
    }

    public function update($unit, $data)
    {
        $unit->update($data['basic']);
        $unit->times()->delete();
        if (isset($data['extra'])) {
            $unit->unitData()->update($data['extra']);
        }
        if (isset($data['pools'])) {
            $unit->pools()->sync($data['pools']);
        }
        if (isset($data['views'])) {
            $unit->views()->sync($data['views']);
        }
        if (isset($data['toilets'])) {
            $unit->toilets()->sync($data['toilets']);
        }
        if (isset($data['kitchens'])) {
            $unit->kitchens()->sync($data['kitchens']);
        }
        if (isset($data['fromDate'])) {
            foreach ($data['fromDate'] as $key => $element) {
                $unit->times()->create([
                    'from' => $element,
                    'to' => $data['toDate'][$key],
                    'price' => $data['price'][$key],
                    'availability' => $data['availability'][$key],
                ]);
            }
        }
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $unit->addMedia($image)->toMediaCollection('images');
            }
        }
    }
}
