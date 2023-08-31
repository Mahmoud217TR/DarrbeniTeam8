<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferenceResource;
use App\Models\Reference;
use Illuminate\Http\Request;
use illuminate\Support\Str;


class ReferenceController extends Controller
{
    
    public function index()
    {
        $references = Reference::with('referenceable')->get([
            'uuid','reference','referenceable_type','referenceable_id'
        ]);
        // foreach($references as $reference){
        //     $date[]=[
        //         'uuid' => $reference->uuid,
        //         'reference' => $reference->reference,
        //         'question' => $reference->question
        //     ];
        // }
        return ReferenceResource::collection($references);
    }

    public function show($uuid)
    {
        $reference = Reference::where('uuid', $uuid)->first();

        $reference->load('referenceable');

        return new ReferenceResource($reference);
    }

    public function store(Request $request)
    {
        $reference = Reference::create([
            'uuid' => Str::uuid(),
            'reference' => $request->input('reference'),
        ]);

        return new ReferenceResource($reference);
    }

    public function update(Request $request, Reference $reference)
    {
        $reference->update([
            'reference' => $request->input('reference'),
        ]);

        return new ReferenceResource($reference);
    }

    public function destroy(Reference $reference)
    {
        $reference->delete();
        return response()->json(['message' => 'Reference deleted successfully']);
    }
    }

