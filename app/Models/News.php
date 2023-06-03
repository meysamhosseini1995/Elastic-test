<?php

namespace App\Models;

use App\Enums\IndexModels;
use App\Enums\ProducerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Service\SearchEngine\Searchable;
use Carbon\Carbon;

/**
 * @property mixed $title
 * @property mixed $content
 * @property mixed $source_link
 * @property mixed $publication_date
 */
class News extends Model
{
    use HasFactory , Searchable;

    protected $fillable = [
        "producer_id",
        "title",
        "content",
        "main_link",
        "source_link",
        "publication_date"
    ];


    protected string $indexName = IndexModels::News->value;

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'source_link' => $this->source_link,
            'producer' => $this->producer()->get(["name","username"]),
            'publication_date' => Carbon::parse($this->publication_date)->format("Y-m-d h:s"),
        ];
    }

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class)->where('type',ProducerType::News);
    }

}
