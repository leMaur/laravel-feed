<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule"
     xmlns:atom="http://www.w3.org/2005/Atom">

    <channel>
        @foreach($meta as $key => $metaItem)
            @if($key === 'link')
                <atom:link href="{{ url($metaItem) }}" rel="self" type="application/rss+xml" />
            @elseif($key === 'updated')
                <pubDate>{{ Carbon\Carbon::parse($metaItem)->toRssString() }}</pubDate>
            @elseif($key === 'id')
            @else
                <{{ $key }}>{{ $metaItem }}</{{ $key }}>
            @endif
        @endforeach
        <link>{{ url('/') }}</link>
        @foreach($items as $item)
            <item>
                <title>{{ $item->title }}</title>
                <guid>{{ url($item->link) }}</guid>
                <link>{{ url($item->link) }}</link>
                <description>{{ $item->summary }}</description>
                @if(isset($item->author))
                <author>{{ $item->author }}</author>
                @endif
                @if(isset($item->image))
                <media:content
                    url="{{ $item->image }}"
                    type="{{ $item->imageType }}"
                    @if(isset($item->imageWidth))
                    width="{{ $item->imageWidth }}"
                    @endif
                    @if(isset($item->imageHeight))
                    height="{{ $item->imageHeight }}"
                    @endif />
                @endif
                @foreach($item->category as $category)
                <category>{{ $category }}</category>
                @endforeach
                <pubDate>{{ $item->updated->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
