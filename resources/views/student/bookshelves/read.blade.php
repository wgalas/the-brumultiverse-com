
<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui,maximum-scale=2">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui,maximum-scale=1">
	<meta http-equiv="cleartype" content="on">

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
	<link rel="shortcut icon" sizes="196x196" href="img/touch/touch-icon-196x196.png">
	<link rel="shortcut icon" href="img/touch/apple-touch-icon.png">
    <x-vendor.alpinejs/>
    <x-vendor.sweetalertjs/>
	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
	<meta name="msapplication-TileColor" content="#222222">

	<!-- SEO: If mobile URL is different from desktop URL, add a canonical link to the desktop page -->
	<!--
	<link rel="canonical" href="http://www.example.com/" >
	-->

	<!-- Add to homescreen for Chrome on Android -->
	<!--
	<meta name="mobile-web-app-capable" content="yes">
	-->

	<!-- For iOS web apps. Delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
	<!--
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="">
	-->

	<!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
	<!--
	<script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
	-->

	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/wow_book/wow_book.css" type="text/css" />
	<link rel="stylesheet" href="/css/main.css">

	<script src="/js/vendor/modernizr-2.7.1.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<!-- Add your site or application content here -->
	<div class='book_container'>
		<div id="book">
		</div>
	</div>

	<!-- if you don't need support for IE8 use jquery 2.1 -->
	<!-- <script src="/js/vendor/jquery-2.1.0.min.js"></script> -->
	<script src="/js/vendor/jquery-1.11.2.min.js"></script>

	<script src="/js/helper.js"></script>
    <script src="/wow_book/pdf.combined.min.js"></script>

	<script src="/wow_book/wow_book.min.js"></script>
	<!-- <script src="/js/main.js"></script> -->
    <script>
        let chapters = @json($work->bookContent->bookContentChapters);
    </script>
	<script>
		var bookOptions = {
				 height   : 500
				,width    : 800
				// ,maxWidth : 800
				,maxHeight : 600,
                pdf:'/storage/{{$work->bookContent->pdf}}',
                centeredWhenClosed : true
				,hardcovers : true
				,toolbar : "left, right,  zoomin, zoomout, flipsound, fullscreen, home"
				,thumbnailsPosition : 'left'
                ,homeURL: "{{route('student.bs.index')}}"
				,responsiveHandleWidth : 10
				,container: window
				,containerPadding: "20px",
                pdfFind:true,
                pdfTextSelectable:true,
                onShowPage (book, page, index) {
                    let end = chapters.filter(e => e.start_page == index)

                    @if(! auth()->user()->isPurchaseBook($work->id))
                    if (end.length) {
                        fetch(`{{route('student.readinglog.check')}}?page_number=${index},book_id={{$work->id}}`)
                            .then(res => res.json())
                            .then(({existing}) => {
                                if (! existing ) {
                                    window.location.href = `{{route('student.bs.block', ['book' => $work->id])}}?chapter=${end[0].id}&page=${index}`;
                                    // swal('You\'re aboout change to another chapter, do you want to continue?', {
                                    //     buttons: ['No', 'Yes']
                                    // }).then( (val) => {
                                    //     if (! val) {
                                    //         swal('Are you sure ? ', {buttons:['No', 'Yes']})
                                    //             .then((val) => {
                                    //                 if (val) {
                                    //                     window.location.href = "{{route('student.bs.index')}}";
                                    //                 } else {
                                    //                     fetch(`{{route('student.readinglog.save')}}?chapter_id=${end[0].id}&book_id={{$work->id}}&page_number=${index}`)
                                    //                         .then(res => res.json())
                                    //                         .then(res => console.log(res))
                                    //                 }
                                    //             })
                                    //     } else {
                                    //         console.log('saving...')
                                    //         fetch(`{{route('student.readinglog.save')}}?chapter_id=${end[0].id}&book_id={{$work->id}}&page_number=${index}`)
                                    //                         .then(res => res.json())
                                    //                         .then(res => console.log(res))
                                    //     }
                                    // })
                                }
                            })
                    }
                    @endif
                },
				// ,toolbarContainerPosition: "top" // default "bottom"

				// Uncomment the option toc to create a Table of Contents
				// ,toc: [                    // table of contents in the format
				// 	[ "Introduction", 2 ],  // [ "title", page number ]
				// 	[ "First chapter", 5 ],
				// 	[ "Go to codecanyon.net", "http://codecanyon.net" ] // or [ "title", "url" ]
				// ]
			};

			$('#book').wowBook( bookOptions ); // create the book
            let book = $.wowBook('#book');
	</script>

{{--
<script>
    let tips = ['tips 1', 'tips 2', 'tips 3']
    swal(`Random tips: ${tips[Math.floor(Math.random() * tips.length)]}`);
</script> --}}

<script>
    var selectedText = ''
    window.oncontextmenu = function (e) {
        e.preventDefault()
        selectedText = window.getSelection().toString()
        if (selectedText.length == 0) {
            return null
        }
        if (selectedText.length <= 100) {
            swal('Do you want to extract the selected text into images? ', {
                buttons: {
                    no: {
                        text: 'No',
                        value: false,
                    },
                    ok: {
                        text: 'Yes',
                        value: true
                    }
                }
            }).then((value) => {
                if (value) {
                    window.open(`{{route('make.quote')}}?book_id={{$work->id}}&text=${selectedText}`, '_blank');
                }
            })
        } else {
            swal("I'm sorry the selected text can't be converted into a quote, only 100 or less characters are allowed.")
        }

    }
</script>
</body>
</html>
