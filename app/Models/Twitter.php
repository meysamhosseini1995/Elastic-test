<?php

namespace App\Models;

use App\Enums\IndexModels;
use App\Enums\ProducerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Service\SearchEngine\Searchable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


/**
 * @property mixed $content
 * @property mixed $source_link
 * @property mixed $publication_date
 */
class Twitter extends Model
{
    use HasFactory , Searchable;

    protected $fillable = [
        "producer_id",
        "retweet",
        "content",
        "image_link",
        "source_link",
        "publication_date"
    ];

    protected string $indexName = IndexModels::Twitter->value;

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'content' => $this->content,
            'source_link' => $this->source_link,
            'producer' => $this->producer()->get(["name","username"]),
            'publication_date' => Carbon::parse($this->publication_date)->format("Y-m-d h:s"),
        ];
    }

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class)->where('type',ProducerType::Twitter);
    }
}
