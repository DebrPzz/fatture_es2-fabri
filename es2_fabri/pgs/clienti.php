<?php 
	$t='clienti';
	$url='?p='.$t;
	if (!empty($_REQUEST['del'])) : 
		$rec=R::load($t, intval($_REQUEST['del']));
		try{
			R::trash($rec);
		} catch (RedBeanPHP\RedException\SQL $e) {
			$msg=$e->getMessage();
		}
	endif;	
	if (!empty($_POST['nome'])) : 
		if (empty($_POST['id'])){
			$rec=R::dispense($t);
		}else{
			$rec=R::load($t,intval($_POST['id']));
		}
		foreach ($_POST as $key=>$value){
			$rec[$key]=$value;
		}
		try {
			$id=R::store($rec);
		} catch (RedBeanPHP\RedException\SQL $e) {
			?>
			<h4 class="msg label error">
				<?=$e->getMessage()?>
			</h4>
			<?php
		}	
	endif;
	
	$data=R::findAll($t);
?>
<h1>
	<a href="index.php">
		Clienti
	</a>
	
</h1>
<section class="">
	<?php foreach ($data as $dt) : ?>
		<article>
			<form method="post" action="<?=$url?>">
				<input name="nome"  value="<?=$dt->nome?>"  />
				<input type="hidden" name="id" value="<?=$dt->id?>" />
				<button type="submit" tabindex="-1">
					Salva
				</button>
				<a href="?p=<?=$url?>&del=<?=$dt['id']?>" class="button dangerous" tabindex="-1">
					Elimina
				</a>					
			</form>
		</article>
	<?php endforeach; ?>
	<article class="card cc">
		<form method="post" action="<?=$url?>">
			<input name="nome" placeholder="Nuova voce" autofocus />
			<button type="submit">
				Inserisci
			</button>
		</form>
	</article>
</section>