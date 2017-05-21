<div id="jukebox" class="all">
	<h4>Ouvir Jukebox</h4>
    <script>
		function like(x){
			if(x == "liked"){
				if(document.getElementById('thumbs-up').className  == "fa fa-thumbs-o-up"){
					document.getElementById('thumbs-up').className  = "fa fa-thumbs-up";
					document.getElementById('thumbs-down').className  = "fa fa-thumbs-o-down";
					document.getElementById('id_unliked').checked = false;
				} else {
					document.getElementById('thumbs-up').className  = "fa fa-thumbs-o-up";
				}
			}
			if(x == "unliked"){
				if(document.getElementById('thumbs-down').className  == "fa fa-thumbs-o-down"){
					document.getElementById('thumbs-down').className  = "fa fa-thumbs-down";
					document.getElementById('thumbs-up').className  = "fa fa-thumbs-o-up";
					document.getElementById('id_liked').checked = false;
				} else {
					document.getElementById('thumbs-down').className  = "fa fa-thumbs-o-down";
				}
			}
		}
	</script>
	<form method="post" action="painel" title="Digite o número de identificação da música">
		<label for="change_id_jukebox"><span><i class="fa fa-crosshairs"></i></span></label><input name="nm_change_id_jukebox" id="change_id_jukebox" type="number" placeholder="Número de identificação" min="1" required><label for="submit_id_jukebox"><span><i class="fa fa-refresh"></i></span></label><input type="submit" style="display:none" id="submit_id_jukebox">
    </form>
    ID atual: <?php if(isset($_POST['nm_change_id_jukebox'])){echo $_POST['nm_change_id_jukebox'];} else {echo 1;} ?><br />
    <embed type="application/x-shockwave-flash" src="http://habboo-a.akamaihd.net/habboweb/63_1d5d8853040f30be0cc82355679bba7c/3322/web-gallery/flash/traxplayer/traxplayer.swf" name="traxplayer" quality="high" base="http://habboo-a.akamaihd.net/habboweb/63_1d5d8853040f30be0cc82355679bba7c/3322/web-gallery/flash/traxplayer/" allowscriptaccess="always" menu="false" wmode="transparent" flashvars="songUrl=http://www.habbo.com.br/trax/song/<?php if(isset($_POST['nm_change_id_jukebox'])){echo $_POST['nm_change_id_jukebox'];} else {echo 1;} ?>&amp;sampleUrl=http://habboo-a.akamaihd.net/dcr/hof_furni//mp3/" height="66" width="210"><br>
    <label for="id_liked_jukebox" onclick="like('liked')"><span class="like"><i class="fa fa-thumbs-o-up" id="thumbs-up"></i></span></label><input name="nm_comentario_jukebox" type="text" placeholder="Comentário" /><label for="id_unliked_jukebox" onclick="like('unliked')"><span class="like"><i class="fa fa-thumbs-o-down" id="thumbs-down"></i></span></label>
    <input type="checkbox" name="like" id="id_liked" value="liked" style="display:none" />
    <input type="checkbox" name="like" id="id_unliked" value="unliked" style="display:none" />
</div>