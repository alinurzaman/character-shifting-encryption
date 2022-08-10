<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    	<table>
        	<tr>
            	<td>Input pesan :</td>
                <td colspan="2"><textarea name="pesan" rows="5" cols="50"><?php if(isset($_POST["pesan"])) echo $_POST["pesan"]; ?></textarea></td>
            </tr>
            <tr>
            	<td></td>
                <td><input type="submit" name="tblencrypt" value="Encrypt" />
                <input type="submit" name="tbldecrypt" value="Decrypt" /></td>
                <td></td>
            </tr>
        </table>
</form>


<?php
	$character = array(	'7', 'x', 'A', '5', 'w', '9', 'Y', '1', 'b', '?', 
						'u', 'M', 'L', 'z', '2', '4', '0', '.', 'c', ';', 
						'!', 'k', 'V', 'e', 'F', '3', 'g', 'i', 'N', 'o', 
						'h', 'd', '8', 'T', '6', 'j', ',', 'Q', 'P', ':', 
						's', 'r', 'K', 'a', 'I', 'n', 'G', 'W', 'B', 'Z',
						'l', 'U', 'y', 'm', 'f', 'X', 'v', 'K', 'E', '"',
						'O', 'S', 't', 'R', 'p', 'q', 'D', 'H', 'J', '=');

	include("lib_enc.php");
	
	
	if(isset($_POST["tblencrypt"])){
		$n = rand(10, 69);
		for ($idx = 0; $idx < 70; $idx++)
		{
			$newidx = $idx + $n;
			if($newidx >= 69) $newidx = $newidx - 69;
			$newchar[$idx] = $character[$newidx];
		}
		$pesan = $_POST["pesan"];
		$panjang = strlen($pesan);
		$bagi = $panjang / 2;
		$i = ceil($bagi);
		echo "<br><h2>Hasil Encrypt :</h2>";
		$enc = encode($n, $newchar, $pesan);
		$pesan_awal = substr($enc, 0, $i);
		$pesan_akhir = substr($enc, $i);
		$n_enc = base64_encode($n);
		$hasil = $pesan_awal.$n_enc.$pesan_akhir;
		?>
		<textarea rows="5" cols="50"><?php echo $hasil; ?></textarea>
        <?php
	}
	else if(isset($_POST["tbldecrypt"])){
		$pesan=$_POST["pesan"];
		$panjang = strlen($pesan);
		$bagi = ($panjang-4) / 2;
		$i = ceil($bagi);
		echo "<br><h2>Hasil Decrypt :</h2>";
		$n = substr($pesan, $i, 4);
		$n_dec = base64_decode($n);
		$pesan_awal = substr($pesan, 0, $i);
		$pesan_akhir = substr($pesan, $i+4);
		$pesan_baru = $pesan_awal.$pesan_akhir;
		for ($idx = 0; $idx < 70; $idx++)
		{
			$newidx = $idx + $n_dec;
			if($newidx >= 69) $newidx = $newidx - 69;
			$newchar[$idx] = $character[$newidx];
		}
		$dec = decode($n_dec, $newchar, $pesan_baru);
		?>
		<textarea rows="5" cols="50"><?php echo $dec; ?></textarea>
        <?php
	}
?>