<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $aboutUsList = AboutUs::all('id', 'about_us');
        return $this->indexResponse($aboutUsList);
    }

    public function store(Request $request)
    {
        $aboutUs = AboutUs::create([
            'about_us' => $request->about_us,
        ]);

        return $this->storeResponse($aboutUs->about_us);
    }

    public function show($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return $this->showResponse($aboutUs->about_us);
    }

    public function update(Request $request, $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->update([
            'about_us' => $request->about_us,
        ]);

        return $this->updateResponse($aboutUs->about_us);
    }

    public function destroy($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();

        return $this->destroyResponse();
    }
}
