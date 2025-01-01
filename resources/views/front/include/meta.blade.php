<meta name="description" content="{{@$meta_info->meta_description}}"/>
    <meta property="og:locale" content="en_GB" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{@$meta_info->meta_title}}" />
    <meta property="og:description" content="{{@$meta_info->meta_description}}" />
    <meta property="og:url" content="{{route('homepage')}}" /> 
    <meta property="og:site_name" content="{{route('homepage')}}" />
    <meta property="og:image" content="{{asset('/uploads/page/'.@$meta_info->thumbnail)}}">

    <meta name="twitter:card" content="{{@$meta_info->meta_title}}" />
    <meta name="twitter:description" content="{{@$meta_info->meta_description}}" />
    <meta name="twitter:title" content="{{@$meta_info->meta_title}}" />
    <meta name="twitter:creator" content="{{@$meta_info->writer}}"/>
    <meta name="twitter:site" content="{{route('homepage')}}"/>
    <meta name="twitter:image" content="{{asset('/uploads/page/'.@$meta_info->thumbnail)}}"> 

    <meta name="keywords" content="{{@$meta_info->meta_keyword}}">
    <meta name="keyphrase" content="{{@$meta_info->meta_keyphrase}}"/>
    
    <meta name="allow-search" content="yes"/>
    <meta name="auther" content="{{@$meta_info->writer}}"/>
    <meta name="visit-after" content="30 days"/>
    <meta name="copyright" content="{{date('Y')}} Language Vision"/>
    <meta name="coverage" content="Worldwide"/>

    <meta name="identifier" content="{{route('homepage')}}"/>
    <meta name="language" content="en"/>
    <link rel="canonical" href="{{route('homepage')}}" />

    <meta name="Robots" content="noodp, noydir, follow, archive"/>
    <meta name="Googlebot" content=" follow"/>
    <link rel="next" href="{{route('homepage')}}">