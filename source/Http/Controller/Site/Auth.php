<?php

namespace Source\Http\Controller\Site;

use Source\Model\Note;
use Source\Http\Controller\Controller;

class Auth extends Controller
{
    public function storeNote( $request)
    {
        $note = new Note();
        // $note->title = $request->title;
        // $note->content =  $request->content;

        $note->save();
    }
}