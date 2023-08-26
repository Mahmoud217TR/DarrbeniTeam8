<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\CourseQuestion;
use App\Models\Favorite;
use App\Models\NationalQuestion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class FavoriteController extends Controller
{
    //
    use ApiResponseTrait;

    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        // Retrieve all favorites for the user with associated questions
        $favorites = Favorite::where('user_id', $user->id)->with('favoriteble')->get();
        
        $favoritedQuestions = [];
        
        foreach ($favorites as $favorite) {
            // Retrieve the question associated with the favorite
            $question = $favorite->favoriteble;
        
            if (!$question) {
                return $this->notfoundResponse('Question not found');
            } else {
                $favoritedQuestions[] = [
                    'id' => $favorite->uuid,
                    'question' => $question->question,
                    'course_name' => optional($question->course)->name??optional($question->spacialization)->name
                ];
            }
        }
        
        return $this->indexResponse($favoritedQuestions);
    }
    
    protected function notfoundResponse($message)
    {
        return response()->json(['message' => $message], 404);
    }
    
    protected function indexResponse($data)
    {
        return response()->json(['data' => $data], 200);
    }
    
    
    


    public function show($uuid)
{
    $user = Auth::user();

    // Retrieve the favorite record associated with the user by its ID
    $favorite = Favorite::where('uuid',$uuid)->first();
    $question = $favorite->favoriteble;
        
    if (!$question) {
        return $this->notfoundResponse('Question not found');
    } else {
        $favoritedQuestions[] = [
            'question' => $question->question,
            'course_name' => optional($question->course)->name??optional($question->spacialization)->name
        ];
    }


    return $this->showResponse($favoritedQuestions);
}


public function store($uuid)
{
    $user = Auth::user(); // Get the authenticated user

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Search for the question with the provided UUID
    $favoritable = CourseQuestion::where('uuid', $uuid)->first();

    if (!$favoritable) {
        $favoritable = NationalQuestion::where('uuid', $uuid)->first();
    }

    if (!$favoritable) {
        return response()->json(['message' => 'Favoritable item not found'], 404);
    }

    // Determine the favoritable type
    $favoritableType = get_class($favoritable);

    // Check if the user has already favorited this item
    $existingFavorite = Favorite::where([
        'favoriteble_type' => $favoritableType,
        'user_id' => $user->id,
        'favoriteble_id' => $favoritable->id,
    ])->first();

    if ($existingFavorite) {
        return response()->json(['message' => 'Item already favorited'], 409);
    }

    // Create the favorite
    $favorite = new Favorite([
        'uuid' => Str::uuid(),
        'user_id' => $user->id,
        'favoriteble_type' => $favoritableType,
        'favoriteble_id' => $favoritable->id,
    ]);
    $favorite->save();

    return response()->json(['message' => 'Favorite created'], 201);
}





public function update(Request $request, $id)
{
    $user = Auth::user();
    $favorite = $user->favoriteble()::findOrFail($id);

    $data = $request->validated();

    $favorite->update([
        'favoriteable_type' => $data['favoriteable_type'],
        'favoriteable_id' => $data['favoriteable_id'],
    ]);

    return $this->showResponse($favorite);
}
public function destroy($uuid)
{
    $user = Auth::user();
    $favorite = Favorite::where('uuid',$uuid);
    $favorite->delete();

    return $this->successResponse('Favorite deleted successfully');
}

}
