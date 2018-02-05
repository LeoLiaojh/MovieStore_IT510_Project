<?php
	echo 
	'<!DOCTYPE html>' .
	'<html lang="en">' .
	'<head>' .
		'<meta charset="utf-8">' .
		'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
		'<title>'. $title. '</title>' .
		'<link rel="stylesheet" type="text/css" href="css/bootstrap.css">' .
		'<link rel="stylesheet" type="text/css" href="css/swiper.css">' .
		'<link rel="stylesheet" type="text/css" href="css/main.css">' .
	'</head>' .
	'<body>' .
		'<header>' .
			'<nav class="navbar navbar-expand-lg navbar-light bg-light">' .
			  '<a class="navbar-brand" href="index.php">Movie Store</a>' .
			  '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">' .
			    '<span class="navbar-toggler-icon"></span>' .
			  '</button>' .

			  '<div class="collapse navbar-collapse" id="navbarSupportedContent">' .
			    '<ul class="navbar-nav mr-auto">' ;
			        if (isset($_COOKIE["user"])) {
			        	# code...
			        	echo 
			        		'<li class="nav-item dropdown">' .
				        		'<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
				        			$_COOKIE["user"] .
				        		'</a>' .
						        '<div class="dropdown-menu" aria-labelledby="navbarDropdown">' .
									'<a class="dropdown-item" href="orders.php">Orders</a>' .
									'<a class="dropdown-item" href="carts.php">Cart</a>' .
									'<div class="dropdown-divider"></div>' .
									'<a class="dropdown-item" onclick="signout()">Sign Out</a>' ;
						        '</div>' .
						      '</li>' ;
			        } else {
			        	echo 
			        		'<li class="nav-item">
								<a class="nav-link" href="login.php">Sign In</a>
							</li>';
			        }
			    echo 
			    '</ul>' .
			    '<form action="movieList.php?id=0&name=Search Result" method="post" class="form-inline my-2 my-lg-0">' .
			      '<input name="search_para" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">' .
			      '<button name="search_sub" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>' .
			    '</form>' .
			  '</div>' .
			'</nav>' .
		'</header>'
	;
?>