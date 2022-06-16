<?php
// Variável que captura o tamanho da imagem 
$w = $_GET['w'];

if (isset($w) && is_numeric($w)){
    
    $file  = "imagens/fundo.png";
    $width = $w;
    $height= $w;
    
    list($width_origin, $height_origin) = getimagesize($file);
    
    $ratio = $width_origin / $height_origin;
    
    if ($width/$height > $ratio) {
        $width = $height * $ratio;
    }else{
        $height = $width / $ratio;
    }
    
    $image_final  = imagecreatetruecolor($width, $height);
    $imagem_origin= imagecreatefrompng($file);
    imagecopyresampled($image_final,$imagem_origin, 0, 0, 0, 0, $width, $height, $width_origin, $height_origin);
  //  header("Content-Type: image/png");
    
   // imagepng($image_final); //Exibe a imagem Mas não salva
    $path = "imagens/"; //diretorio da imagem
    $novaImagem = $w."-mini.png"; //novo nome do arquivo
    if (imagepng($image_final, $novaImagem)) //salva para um arquivo
    {
        header("Content-Type: image/png");
        readfile($novaImagem);

        rename( "./".$novaImagem, $path.$novaImagem );
    } else {
        echo 'Erro ao salvar';
    }
    
} else {
    echo "Imagem não encontrada, ou a largura não é um número válido";
}
