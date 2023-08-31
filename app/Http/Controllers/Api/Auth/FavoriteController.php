<?php

namespace App\Http\Controllers\Api\Auth;
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
    use ApiResponseTrait;

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->notFoundResponse('Unauthorized', 401);
        }

        $favorites = Favorite::where('user_id', $user->id)->with('favoriteble')->get();

        $favoritedQuestions = [];

        foreach ($favorites as $favorite) {
            $question = $favorite->favoriteble;

            if (!$question) {
                return $this->notFoundResponse('Question not found');
            } else {
                $favoritedQuestions[] = [
                    'id' => $favorite->uuid,
                    'id_question' => $question->uuid,
                    'question' => $question->question,
                    'course_name' => optional($question->course)->name ?? optional($question->spacialization)->name,
                ];
            }
        }

        return $this->indexResponse($favoritedQuestions);
    }



    public function show($uuid)
    {
        $user = Auth::user();
    
        $favorite = Favorite::where('uuid', $uuid)->first();
        $favoritedQuestion = $favorite->favoriteble;
    
        if (!$favoritedQuestion) {
            return $this->notFoundResponse('Question not found');
        }
    
        $question = CourseQuestion::where('uuid', $favoritedQuestion->uuid)->first();
    
        if (!$question) {
            $question = NationalQuestion::where('uuid', $favoritedQuestion->uuid)->first();
        }
    
        if (!$question) {
            return $this->notFoundResponse('Favoritable Not Found');
        }
    
        $answers = [];
    
        foreach ($question->answers as $answer) {
            $status = $answer->pivot->status ?? $answer->status;
    
            if ($status == 1) {
                $answers[] = [
                    'answer' => $answer->answer,
                    // 'status' => $status
                ];
            }
        }
    
        $data = [
            'question' => $question->question,
            'reference' => $question->reference ? $question->reference->reference : null,
            'answers' => $answers
        ];
    
        return $this->showResponse($data);
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->id;

        if (!$user) {
            return $this->notFoundResponse('User Not Found');
        }

        $favoriteble = CourseQuestion::where('uuid', $uuid)->first();

        if (!$favoriteble) {
            $favoriteble = NationalQuestion::where('uuid', $uuid)->first();
        }

        if (!$favoriteble) {
            return $this->notFoundResponse('Favoritable Not Found');
        }

        $favoritableType = get_class($favoriteble);

        $existingFavorite = Favorite::where([
            'favoriteble_type' => $favoritableType,
            'user_id' => $user->id,
            'favoriteble_id' => $favoriteble->id,
        ])->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'Item already favorited'], 409);
        }

        $favorite = Favorite::create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'favoriteble_type' => $favoritableType,
            'favoriteble_id' => $favoriteble->id,
        ]);

        return $this->storeResponse($favorite->uuid);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $favorite = $user->favoriteble()->findOrFail($id);

        $data = $request->validated();

        $favorite->update([
            'favoritable_type' => $data['favoritable_type'],
            'favoritable_id' => $data['favoritable_id'],
        ]);

        return $this->showResponse($favorite);
    }

    public function destroy($uuid)
    {
        $user = Auth::user();
        $favorite = Favorite::where('uuid', $uuid)->first();
        $favorite->delete();

        return $this->successResponse('Favorite deleted successfully');
    }
}
