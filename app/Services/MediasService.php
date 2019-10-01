<?php


namespace App\Services;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Exception;
use MediaUploader;

class MediasService
{
    /**
     * @param Model  $model
     * @param array  $medias
     * @param string $group
     */
    public function storeMedias(Model $model, array $medias, string $group = null): void
    {
        $preferences = config('file_preferences');

        foreach ($medias as $media) {
            $media_type = current(explode('/', $media->getMimeType()));
            if ($media_type == 'image') {
                $media_filename = pathinfo($media->getClientOriginalName(), PATHINFO_FILENAME);

                $m_original_media = MediaUploader::fromSource($media)->toDestination('public', $preferences['images_folder'])
                                                 ->useFilename($media_filename . '-original')->upload();

                if ($group)
                    $model->attachMedia($m_original_media, [$group]);
                else
                    $model->attachMedia($m_original_media, ['medias']);

                foreach ($preferences['sizes'] as $key => $dimension) {
                    $resized_media = \Image::make($media)->resize($dimension[0], $dimension[1])->encode('jpg', $preferences['quality']);
                    $m_resized_media = MediaUploader::fromString($resized_media)->toDestination('public', $preferences['images_folder'])
                                                    ->useFilename($media_filename . '-' . $key)->upload();

                    if ($group)
                        $model->attachMedia($m_resized_media, [$group]);
                    else
                        $model->attachMedia($m_resized_media, ['medias']);
                }
            }
        }
    }

    public function removeMedia(int $id): array
    {
        $preferences = config('file_preferences');

        try{
            if($media = Media::where('id', $id)->first()){
                $ex = explode('-', $media->filename);
                if(is_numeric($ex[count($ex) - 1])){
                    $aux = $ex;
                    $aux[count($aux) - 2] = 'original';
                    $filename = implode($aux, '-');

                    $media = Media::where('filename', $filename)->first();
                    if($media) $media->delete();

                    foreach($preferences['sizes'] as $key => $dimension){
                        $aux = $ex;
                        $aux[count($aux) - 2] = $key;
                        $filename = implode($aux,'-');

                        $media = Media::where('filename', $filename)->first();
                        if($media) $media->delete();
                    }
                } else {
                    $filename = implode(array_slice($ex,0,count($ex)-1), '-');
                    $media->delete();

                    $media = Media::where('filename', $filename . '-original')->first();

                    if($media)
                        $media->delete();

                    foreach($preferences['sizes'] as $key => $dimension){
                        $media = Media::where('filename', $filename . '-' . $key)->first();
                        if($media) $media->delete();
                    }
                }
            }
            return [
                'success' => true,
                'message' => 'Media removed successfully',
            ];
        } catch(Exception $e) {
            return [
                'success' => false,
                'message' => 'Error, please remove the entire model.',
            ];
        }
    }

}
