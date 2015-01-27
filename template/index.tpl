<div id="chargement">Loading articles... <i class="fa fa-spinner fa-spin"></i></div>
<div id="containers">
	<H4>{$titre_dyn}</H4>

	{foreach $tab_articles AS $article}
		<H3>{$article.titre}</H3>
		
		<!-- Si le texte est supérieur à 400 caractères on affiche trois petits points et un bouton pour lire la suite -->
		{if $article.texte|strlen <= 400}
			<p>{$article.texte}</p>
		{else}
			<p>{$article.texte|substr:0:400}...</p>
			<a href='#' data-id='{$article.id_article}' class='afficher-article'> Lire la suite </a><br><br>
		{/if}
		
		<div class='date'>Créé le : {$article.date} </div>
		<div class='date'>Par : {$article.nom} {$article.prenom}</div>
		
		<BR>
		
		{if $article.date_modif != ""}
			<div class='date'>Modifié le : {$article.date_modif}</div>
		{/if}	
		
		{if $connecte}
			<a href = 'article.php?id={$article.id_article}' class= 'btn btn-primary'> Modifier</a>
			<a href = 'sup_article.php?id={$article.id_article}' class= 'btn btn-danger'> Supprimer</a>
		{/if}
		
		<br><br><hr>
	{/foreach}

		<!--Pagination-->
	{if isset($smarty.get.r)}	<!--Si c'est une recherche-->
		<nav>
			<ul class="pagination center">
			{if $page!=1}
				<li  class= "enabled" ><a href="index.php?r={$recherche}&p={$page-1}"> &laquo; </a></li>
			{/if}
			{for $n=1 to $nb_pages}
				<li><a href="index.php?r={$recherche}&p={$n}">{$n}</a></li>
			{/for}
			{if $page+1 <= $nb_pages} 
				<li  class= "enabled" ><a href="index.php?r={$recherche}&p={$page+1}"> &raquo; </a></li>
			{/if} 
			</ul>
		</nav>
	{else} 	<!--Sinon-->
		<nav>
			<ul class="pagination center">
			{if $page!=1}
				<li  class= "enabled" ><a href="index.php?p={$page-1}"> &laquo; </a></li>
			{/if}
			{for $n=1 to $nb_pages}
				{if $n == ($smarty.get.p)}
					<li class="active"><a href="index.php?p={$n}">{$n}</a></li>
				{else}
					<li><a href="index.php?p={$n}">{$n}</a></li>
				{/if}
			{/for} 
			{if $page+1 <= $nb_pages} 
				<li  class= "enabled" ><a href="index.php?p={$page+1}"> &raquo; </a></li>
			{/if}
			</ul>
		</nav>
	{/if}
</div>

<script>
	$(document).ready(function() {
		$.pageLoader();
	});
</script>