<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Helvetica, Arial, sans-serif;
            color: #666;
            background: #f2f2f2; 
            font-size: 1em;
            line-height: 1.5em;
        }

        h1 {
            font-size: 2.3em;
            line-height: 1.3em;
            margin: 15px 0;
            text-align: center;
            font-weight: 300;
        }

                #main-header {
            background: #333;
            color: white;
            height: 80px;
        }	
	#main-header a {
		color: white;
	}

/*
 * Logo
 */
    #logo-header {
        float: left;
        padding: 15px 0 0 20px;
        text-decoration: none;
    }
        #logo-header:hover {
            color: #0b76a6;
        }
        
        #logo-header .site-name {
            display: block;
            font-weight: 700;
            font-size: 1.2em;
        }
        
        #logo-header .site-desc {
            display: block;
            font-weight: 300;
            font-size: 0.8em;
            color: #999;
        }
        

    /*
    * Navegación
    */
    nav {
        float: right;
    }
        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            padding-right: 20px;
        }
        
            nav ul li {
                display: inline-block;
                line-height: 80px;
            }
                
                nav ul li a {
                    display: block;
                    padding: 0 10px;
                    text-decoration: none;
                }
                
                    nav ul li a:hover {
                        background: #0b76a6;
                    }
    </style>
</head>
<body>
    @include('layouts.partials.header')
    @yield('body_content')
</body>
</html>