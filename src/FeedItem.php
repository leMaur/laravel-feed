<?php

namespace Spatie\Feed;

use Carbon\Carbon;
use Exception;
use Spatie\Feed\Exceptions\InvalidFeedItem;

class FeedItem
{
    protected ?string $id = null;

    protected string $title;

    protected Carbon $updated;

    protected string $summary;

    protected string $link;

    protected string $enclosure;

    protected int $enclosureLength;

    protected string $enclosureType;

    protected ?string $author = null;

    protected array $category = [];

    protected string $image;

    protected string $imageType;

    protected ?int $imageWidth = null;

    protected ?int $imageHeight = null;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if ($key === 'category') {
                $this->category = (array) $value;

                continue;
            }

            $this->$key = $value;
        }
    }

    public static function create(array $data = []): self
    {
        return new static($data);
    }

    public function id(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function updated(Carbon $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function summary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function link(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function enclosure(string $enclosure): self
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    public function enclosureLength(int $enclosureLength): self
    {
        $this->enclosureLength = $enclosureLength;

        return $this;
    }

    public function enclosureType(string $enclosureType): self
    {
        $this->enclosureType = $enclosureType;

        return $this;
    }

    public function image(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function imageType(string $imageType): self
    {
        $this->imageType = $imageType;

        return $this;
    }

    public function imageWidth(int $imageWidth): self
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    public function imageHeight(int $imageHeight): self
    {
        $this->imageHeight = $imageHeight;

        return $this;
    }

    public function author(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function category(string ...$category): self
    {
        $this->category = $category;

        return $this;
    }

    public function validate(): void
    {
        $requiredFields = ['id', 'title', 'updated', 'summary', 'link'];

        foreach ($requiredFields as $requiredField) {
            if (is_null($this->$requiredField)) {
                throw InvalidFeedItem::missingField($this, $requiredField);
            }
        }
    }

    public function __get($key)
    {
        if (! isset($this->$key)) {
            throw new Exception("Property `{$key}` doesn't exist");
        }

        return $this->$key;
    }

    public function __isset($key)
    {
        return isset($this->$key);
    }
}
