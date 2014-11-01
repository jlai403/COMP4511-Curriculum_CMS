<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');

$searchResultsDto = SessionManager::get("searchResults");
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Dashboard</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap-theme.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/search-results.css" />
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="/Content/css/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" style="height: 150px;">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand nav-logo" href="/View">
						<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" />
					</a>
				</div>
	
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse"
					id="bs-example-navbar-collapse-1">
					<ul class="nav nav-pills navbar-right">
						<!-- NAV LINKS START -->
						<li> <a href="/View/Program/Request.php">Create Program</a> </li>
						<li> <a href="/Controller/UserController.php?action=logout">Logout</a> </li>
						<!-- NAV LINKS END -->
					</ul>
				</div> <!-- /.navbar-collapse -->
			</div> <!-- /.container-fluid -->
		</nav>
		
		<div class="container search-results center">
	        <div class="row">
                <form action="/Controller/SearchController.php?action=query" method="post">
                    <input name="queryString" class="async-search form-control" type="text">
                    <i class="glyphicon glyphicon-search form-control-feedback" style="position: relative; top: -34px; float: right;"></i>
                </form>
	        </div>

            <div class="row">
				<h1 class="center-text">Search Results For '<span class="queryString"><?= $searchResultsDto->getQueryString() ?></span>'</h1>
			</div>
			
			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th>Type</th>
							<th>Name</th>
							<th>Requester</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($searchResultsDto->getSearchResultDtos() as $searchResultDto) {  ?>
                            <tr class="search-result" data-url="<?= $searchResultDto->getUri() ?>">
                                <td>
                                    <a href="<?= $searchResultDto->getUri() ?>"> <?= $searchResultDto->getType() ?> </a>
                                </td>
                                <td>
                                    <a href="<?= $searchResultDto->getUri() ?>"> <?= $searchResultDto->getName() ?> </a>
                                </td>
                                <td>
                                    <a href="<?= $searchResultDto->getUri() ?>"> <?= $searchResultDto->getRequesterFullName() ?> </a>
                                </td>
                            </tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html> 

<script>
    $(document).ready(function(){
        bindClickForSearchResultRow();
    });

    $('.async-search').keyup(function(){
        var queryString = $(this).val();
        $('.queryString').text(queryString);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/Controller/SearchController.php?action=asyncQuery",
            data: { queryString : queryString },
            async: true,
            success: function(jsonData){
                $(".search-results .table thead>tr>th").removeClass("sorted");
                reloadSearchResults(jsonData);
                bindClickForSearchResultRow();
            }
        });
    });

    $(".search-results .table").on("click", "th", function(e){
        var clickedElement = $(this);

        var url = "/Controller/SearchController.php?action=sort";
        var sortBy = clickedElement.text();
        var queryString = $('.queryString').text();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: url,
            data: {
                sortBy: sortBy,
                queryString: queryString
            },
            async: true,
            success: function(jsonData) {
                $(".search-results .table thead>tr>th").removeClass("sorted");
                clickedElement.addClass("sorted");
                reloadSearchResults(jsonData);
                bindClickForSearchResultRow();
            }
        });
    });

    function bindClickForSearchResultRow(){
        $(".search-result").click(function (){
            window.location.href = $(this).data('url');
        });
    }

    function reloadSearchResults(jsonData){
        var searchResultBody = $(".search-results .table tbody");
        searchResultBody.empty();

        for (var index in jsonData) {
            var searchResultDto = jsonData[index].searchResultDto;
            var row = $("<tr></tr>").addClass("search-result").attr("data-url", searchResultDto.uri);
            var typeColumn = $("<td></td>").text(searchResultDto.type);
            var nameColumn = $("<td></td>").text(searchResultDto.name);
            var requesterColumn = $("<td></td>").text(searchResultDto.requester);

            row.append(typeColumn);
            row.append(nameColumn);
            row.append(requesterColumn);

            searchResultBody.append(row);
        }
    }
</script>