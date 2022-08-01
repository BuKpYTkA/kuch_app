<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $title
 * @property string $description
 * @property int|null $category_id
 * @property int $price
 *
 * @property Category|null $category
 */
class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    private const MAIN_IMAGE_MEDIA_COLLECTION = 'main_image';

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price'
    ];

    protected $hidden = [
        'media'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @param UploadedFile $file
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addMainImage(UploadedFile $file): void
    {
        $this->getMainImage()?->delete();
        $this->addMedia($file)->toMediaCollection(self::MAIN_IMAGE_MEDIA_COLLECTION);
    }

    /**
     * @param string $content
     * @return void
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws InvalidBase64Data
     */
    public function addMainImageFromContent(string $content): void
    {
        $this->getMainImage()?->delete();
        $this->addMediaFromBase64(base64_encode($content))->toMediaCollection(self::MAIN_IMAGE_MEDIA_COLLECTION);
    }

    public function getMainImage(): ?Media
    {
        return $this->getFirstMedia(self::MAIN_IMAGE_MEDIA_COLLECTION);
    }
}
