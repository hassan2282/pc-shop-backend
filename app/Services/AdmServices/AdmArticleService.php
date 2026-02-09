<?php

namespace App\Services\AdmServices;

use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Http\Resources\AdmArticleResource;
use App\Models\Article;
use App\Models\Tag;
use App\Repositories\AdmRepo\Article\AdmArticleRepositoryInterface;
use App\Repositories\AdmRepo\Tag\AdmTagRepositoryInterface;
use App\Repositories\Media\MediaRepositoryInterface;
use App\Services\ImageOptimizerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class AdmArticleService extends BaseService
{
    public function __construct(
        AdmArticleRepositoryInterface $repository,
        readonly protected MediaRepositoryInterface $mediaRepository,
        readonly protected AdmTagRepositoryInterface $tagRepository
    ) {
        parent::__construct($repository, StoreArticleRequest::class, UpdateArticleRequest::class);
    }





    public function articlesWithRelation()
    {
        $collection = $this->repository->articlesWithRelation();
        $data = AdmArticleResource::collection($collection);

        return response()->json($data, HttpResponse::HTTP_OK);
    }




    public function createArticle(StoreArticleRequest $request)
    {
        $user = Auth::user();
        try {
            // Start Article
            $article = [
                'title' => $request->title,
                'description' => $request->description,
                'text' => $request->text,
                'author_id' => $request->author_id ? $request->author_id : $user->id,
                'category_id' => $request->category_id,
            ];
            $articleRes = $this->repository->create($article);
            // End Article


            //Start Media
            $image = $request->file('media');
            $image_name = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('media', $image_name, 'public');
            $absolutePath = Storage::disk('public')->path($path);
            ImageOptimizerService::optimize($absolutePath);
            $media = [
                'name' => $image_name,
                'mimeType' => $image->getMimeType(),
                'size' => $image->getSize(),
                'mediable_type' => Article::class,
                'mediable_id' => $articleRes->id,
                'alt' => 'Article Image'
            ];
            $mediaRes = $this->mediaRepository->create($media);
            // End Media    


            // Start Tag
            $tags = $request->tags;
            foreach ($tags as $tag) {
                $find = $this->tagRepository->where('name', $tag)->first();
                if (! !!$find) {
                    $tagRes = $this->tagRepository->create([
                        'name' => $tag,
                    ]);

                    $articleRes->tags()->syncWithoutDetaching($tagRes->id);
                }
            }
            // Edn Tag

            return response()->json('مقاله با موفقیت افزوده شد', HttpResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }







    public function showWithRelation(int $id)
    {
        return $this->repository->showWithRelation($id);
    }




    public function updateWithRelation(int $id, UpdateArticleRequest $request)
    {

        try {

            $article = $this->repository->find($id);
            $articleData = [
                'title' => $request->title,
                'description' => $request->description,
                'text' => $request->text,
                'category_id' => $request->category_id,
            ];
            $article->update($articleData);

            if ($request->hasFile('media')) {
                $image = $article->media;
                Storage::disk('public')->delete('/media/' . $image->name);
                $image->delete();

                $image = $request->file('media');
                $image_name = time() . '-' . Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('media', $image_name, 'public');
                $absolutePath = Storage::disk('public')->path($path);
                ImageOptimizerService::optimize($absolutePath);
                $media = [
                    'name' => $image_name,
                    'mimeType' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'mediable_type' => Article::class,
                    'mediable_id' => $article->id,
                    'alt' => 'Article Image'
                ];
                $mediaRes = $this->mediaRepository->create($media);
            }


            $oldTagIds = $article->tags()->pluck('tags.id')->toArray();

            $article->tags()->detach();

            $newTagIds = [];
            foreach ($request->tags as $tagName) {
                $tag = Tag::firstOrCreate([
                    'name' => $tagName,
                ]);
                $newTagIds[] = $tag->id;
            }

            $article->tags()->sync($newTagIds);

            Tag::whereIn('id', $oldTagIds)
                ->whereDoesntHave('articles')
                ->delete();

            return response()->json('مقاله با موفقیت ویرایش شد', HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    public function deleteWithRelations(int $id)
    {
        try {
            $article = $this->repository->find($id);
            $image = $article->media;

            foreach ($article->tags as $tag) {
                $tag->delete();
            }
            Storage::disk('public')->delete('/media/' . $image->name);
            $image->delete();
            $article->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json('مقاله با موفقیت حذف شد', HttpResponse::HTTP_OK);
    }
}
