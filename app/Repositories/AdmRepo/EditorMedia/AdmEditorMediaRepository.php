<?php

namespace App\Repositories\AdmRepo\EditorMedia;

use App\Models\EditorMedia;
use App\Repositories\AdmRepo\EditorMedia\AdmEditorMediaRepositoryInterface;
use App\Repositories\BaseRepository;

class AdmEditorMediaRepository extends BaseRepository implements AdmEditorMediaRepositoryInterface
{
    public function __construct(EditorMedia $editorMedia)
    {
        parent::__construct($editorMedia);
    }
}
