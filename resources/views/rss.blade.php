<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule"
     xmlns:atom="http://www.w3.org/2005/Atom">

    <channel>
        <title><![CDATA[{{ $meta['title'] }}]]></title>
        <link><![CDATA[{{ url($meta['link']) }}]]></link>
        <description><![CDATA[{{ $meta['description'] }}]]></description>
        <language>{{ $meta['language'] }}</language>
        <pubDate>{{ $meta['updated'] }}</pubDate>

        @foreach($items as $item)
            <item>
                <title><![CDATA[{{ $item->title }}]]></title>
                <link>{{ url($item->link) }}</link>
                <description><![CDATA[{!! $item->summary !!}]]></description>
                @if(isset($item->author))
                <author><![CDATA[{{ $item->author }}]]></author>
                @endif
                <guid>{{ url($item->id) }}</guid>
                <pubDate>{{ $item->updated->toRssString() }}</pubDate>
                @foreach($item->category as $category)
                <category>{{ $category }}</category>
                @endforeach
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
            </item>
        @endforeach
    </channel>
</rss>
