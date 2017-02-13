<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Comment;


class CommentController extends BaseController
{
    /**
     * Get all comments as JSON
     *
     * @return Response
     */
    public function getAll()
    {
      return response()->json(Comment::get());
    }

    
    /**
     * Save a newly created resource in storage.
     *
     * @return Response
     */
    public function post(Request $request)
    {
      return responce()->json(Comment::create($request->all()));
    }

}
